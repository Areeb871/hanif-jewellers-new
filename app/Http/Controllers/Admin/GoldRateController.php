<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoldRateSetting;
use App\Models\GoldServiceSetting;
use Illuminate\Http\Request;

class GoldRateController extends Controller
{
    /**
     * Show and edit Pakistan gold rate settings.
     */
    public function index()
    {
        return $this->renderIndex('pk');
    }

    /**
     * Show and edit UAE gold rate settings.
     */
    public function indexUae()
    {
        return $this->renderIndex('uae');
    }

    /**
     * Store/update Pakistan gold rate settings.
     */
    public function update(Request $request)
    {
        return $this->persist($request, 'pk');
    }

    /**
     * Store/update UAE gold rate settings.
     */
    public function updateUae(Request $request)
    {
        return $this->persist($request, 'uae');
    }

    private function renderIndex(string $market)
    {
        $karats = [18, 21, 22, 24];

        $settings = GoldRateSetting::forMarket($market)
            ->whereIn('karat', $karats)
            ->get()
            ->keyBy('karat');

        foreach ($karats as $karat) {
            if (! isset($settings[$karat])) {
                $settings[$karat] = new GoldRateSetting([
                    'market' => $market,
                    'karat' => $karat,
                    'gold_rate_per_gram' => 0,
                    'vat_percent' => $market === 'uae' ? 5 : 4,
                    'is_active' => true,
                ]);
            }
        }

        return view('admin.gold_rates.index', [
            'settings' => $settings,
            'karats' => $karats,
            'services' => GoldServiceSetting::forMarket($market)->orderBy('sort_order')->get(),
            'market' => $market,
            'currencyLabel' => $market === 'uae' ? 'AED' : 'PKR',
            'countryLabel' => $market === 'uae' ? 'UAE (Dubai)' : 'Pakistan',
            'pageTitle' => $market === 'uae'
                ? 'Manage Gold Rates UAE — Dubai Jewellery Services'
                : 'Manage Gold Rates — Pakistan',
            'formAction' => $market === 'uae'
                ? route('admin.gold-rates-uae.update')
                : route('admin.gold-rates.update'),
        ]);
    }

    private function persist(Request $request, string $market)
    {
        $karats = [18, 21, 22, 24];

        $rules = [];
        foreach ($karats as $karat) {
            $rules["gold_rate.$karat"] = 'nullable|numeric|min:0';
            $rules["vat_percent.$karat"] = 'nullable|numeric|min:0';
        }

        $services = GoldServiceSetting::forMarket($market)->get();

        foreach ($services->pluck('id') as $serviceId) {
            if ($market === 'uae') {
                $rules["services.$serviceId.selling_percent"] = 'required|numeric|min:0|max:100';
                $rules["services.$serviceId.sale_selling_percent"] = 'required|numeric|min:0|max:100';
                continue;
            }

            $rules["services.$serviceId.weight_threshold"] = 'required|numeric|min:0.001';
            $rules["services.$serviceId.above_weight_threshold"] = "required|numeric|min:0.001|same:services.$serviceId.weight_threshold";
            $rules["services.$serviceId.light_oc_final_per_article"] = 'required|numeric|min:0';
            $rules["services.$serviceId.heavy_oc_final_per_gram"] = 'required|numeric|min:0';
            $rules["services.$serviceId.sale_weight_threshold"] = 'required|numeric|min:0.001';
            $rules["services.$serviceId.above_sale_weight_threshold"] = "required|numeric|min:0.001|same:services.$serviceId.sale_weight_threshold";
            $rules["services.$serviceId.sale_light_oc_final_per_article"] = 'required|numeric|min:0';
            $rules["services.$serviceId.sale_heavy_oc_final_per_gram"] = 'required|numeric|min:0';
        }

        $validated = $request->validate($rules);

        foreach ($karats as $karat) {
            $goldRate = $request->input("gold_rate.$karat", 0);
            $vat = $request->input("vat_percent.$karat", $market === 'uae' ? 5 : 4);
            $active = $request->boolean("is_active.$karat");

            GoldRateSetting::updateOrCreate(
                ['karat' => $karat, 'market' => $market],
                [
                    'gold_rate_per_gram' => $goldRate,
                    'vat_percent' => $vat,
                    'is_active' => $active,
                ]
            );
        }

        foreach ($services as $service) {
            $serviceValues = $validated['services'][$service->id] ?? null;
            if (! $serviceValues) {
                continue;
            }

            unset($serviceValues['above_weight_threshold'], $serviceValues['above_sale_weight_threshold']);

            if ($market === 'uae') {
                $serviceValues = [
                    'selling_percent' => $serviceValues['selling_percent'],
                    'sale_selling_percent' => $serviceValues['sale_selling_percent'],
                ];
            }

            $service->update([
                ...$serviceValues,
                'is_active' => $request->boolean("service_active.{$service->id}"),
                'is_sale' => $request->boolean("service_sale.{$service->id}"),
            ]);
        }

        $route = $market === 'uae' ? 'admin.gold-rates-uae.index' : 'admin.gold-rates.index';
        $message = $market === 'uae'
            ? 'UAE gold rates and jewellery services updated successfully.'
            : 'Gold rates and jewellery services updated successfully.';

        return redirect()->route($route)->with('success', $message);
    }
}
