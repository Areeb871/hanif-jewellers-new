<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoldRateSetting;

class GoldRateController extends Controller
{
    /**
     * Show and edit gold rate settings for 18k, 21k, 22k, 24k.
     */
    public function index()
    {
        $karats = [18, 21, 22, 24];

        $settings = GoldRateSetting::whereIn('karat', $karats)
            ->get()
            ->keyBy('karat');

        // Ensure all karats exist in the array (not necessarily in DB)
        foreach ($karats as $karat) {
            if (!isset($settings[$karat])) {
                $settings[$karat] = new GoldRateSetting([
                    'karat' => $karat,
                    'gold_rate_per_gram' => 0,
                    'making_charges_per_gram' => 0,
                    'vat_percent' => 4,
                    'is_active' => true,
                ]);
            }
        }

        return view('admin.gold_rates.index', [
            'settings' => $settings,
            'karats' => $karats,
        ]);
    }

    /**
     * Store/update gold rate settings.
     */
    public function update(Request $request)
    {
        $karats = [18, 21, 22, 24];

        foreach ($karats as $karat) {
            $request->validate([
                "gold_rate.$karat" => 'nullable|numeric|min:0',
                "making_charges.$karat" => 'nullable|numeric|min:0',
                "vat_percent.$karat" => 'nullable|numeric|min:0',
            ]);

            $goldRate = $request->input("gold_rate.$karat", 0);
            $making = $request->input("making_charges.$karat", 0);
            $vat = $request->input("vat_percent.$karat", 4);
            $active = $request->boolean("is_active.$karat", true);

            GoldRateSetting::updateOrCreate(
                ['karat' => $karat],
                [
                    'gold_rate_per_gram' => $goldRate,
                    'making_charges_per_gram' => $making,
                    'vat_percent' => $vat,
                    'is_active' => $active,
                ]
            );
        }

        return redirect()
            ->route('admin.gold-rates.index')
            ->with('success', 'Gold rates updated successfully.');
    }
}

