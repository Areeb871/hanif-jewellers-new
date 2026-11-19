<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiamondRateSetting;
use App\Models\GoldRateSetting;
use Illuminate\Http\Request;

class DiamondRateController extends Controller
{
    public function index()
    {
        return $this->renderIndex('pk');
    }

    public function indexUae()
    {
        return $this->renderIndex('uae');
    }

    public function update(Request $request)
    {
        return $this->persist($request, 'pk');
    }

    public function updateUae(Request $request)
    {
        return $this->persist($request, 'uae');
    }

    private function renderIndex(string $market)
    {
        $karats = [18, 21, 22, 24];

        $settings = DiamondRateSetting::forMarket($market)
            ->whereIn('karat', $karats)
            ->get()
            ->keyBy('karat');

        $goldRates = GoldRateSetting::forMarket($market)
            ->whereIn('karat', $karats)
            ->get()
            ->keyBy('karat');

        foreach ($karats as $karat) {
            if (! isset($settings[$karat])) {
                $settings[$karat] = new DiamondRateSetting([
                    'market' => $market,
                    'karat' => $karat,
                    'rate_per_carat' => 0,
                    'making_charge' => 0,
                    'gst_percent' => $market === 'uae' ? 5 : 4,
                    'dollar_rate' => 0,
                    'discount_percent' => 0,
                    'is_active' => true,
                ]);
            }
        }

        return view('admin.diamond_rates.index', [
            'settings' => $settings,
            'goldRates' => $goldRates,
            'karats' => $karats,
            'market' => $market,
            'currencyLabel' => $market === 'uae' ? 'AED' : 'PKR',
            'pageTitle' => $market === 'uae'
                ? 'Manage Diamond Rates UAE — Dubai'
                : 'Manage Diamond Rates — Pakistan',
            'formAction' => $market === 'uae'
                ? route('admin.diamond-rates-uae.update')
                : route('admin.diamond-rates.update'),
            'goldRatesUrl' => $market === 'uae'
                ? route('admin.gold-rates-uae.index')
                : route('admin.gold-rates.index'),
        ]);
    }

    private function persist(Request $request, string $market)
    {
        $karats = [18, 21, 22, 24];

        foreach ($karats as $karat) {
            $rules = [
                "gold_rate.$karat" => 'nullable|numeric|min:0',
                "gst_percent.$karat" => 'nullable|numeric|min:0',
                "dollar_rate.$karat" => 'nullable|numeric|min:0',
                "discount_percent.$karat" => 'nullable|numeric|min:0',
            ];
            if ($market !== 'uae') {
                $rules["making_charge.$karat"] = 'nullable|numeric|min:0';
            }
            $request->validate($rules);

            $goldRate = (float) $request->input("gold_rate.$karat", 0);
            $isActive = $request->boolean("is_active.$karat");

            $goldValues = [
                'gold_rate_per_gram' => $goldRate,
                'is_active' => $isActive,
            ];
            if ($market !== 'uae') {
                $goldValues['vat_percent'] = 4;
            }

            GoldRateSetting::updateOrCreate(
                ['karat' => $karat, 'market' => $market],
                $goldValues
            );

            $diamondValues = [
                'rate_per_carat' => $goldRate,
                'gst_percent' => $request->input("gst_percent.$karat", $market === 'uae' ? 5 : 4),
                'dollar_rate' => $request->input("dollar_rate.$karat", 0),
                'discount_percent' => $request->input("discount_percent.$karat", 0),
                'is_active' => $isActive,
            ];
            if ($market !== 'uae') {
                $diamondValues['making_charge'] = $request->input("making_charge.$karat", 0);
            }

            DiamondRateSetting::updateOrCreate(
                ['karat' => $karat, 'market' => $market],
                $diamondValues
            );
        }

        return redirect()
            ->route($market === 'uae' ? 'admin.diamond-rates-uae.index' : 'admin.diamond-rates.index')
            ->with('success', $market === 'uae'
                ? 'Dubai diamond rates updated successfully (AED).'
                : 'Pakistan diamond rates updated successfully.');
    }
}
