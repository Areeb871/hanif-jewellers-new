<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoldRateSetting;
use App\Models\GoldServiceSetting;

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
                    'vat_percent' => 4,
                    'is_active' => true,
                ]);
            }
        }

        return view('admin.gold_rates.index', [
            'settings' => $settings,
            'karats' => $karats,
            'services' => GoldServiceSetting::orderBy('sort_order')->get(),
        ]);
    }

    /**
     * Store/update gold rate settings.
     */
    public function update(Request $request)
    {
        $karats = [18, 21, 22, 24];

        $rules = [];
        foreach ($karats as $karat) {
            $rules["gold_rate.$karat"] = 'nullable|numeric|min:0';
            $rules["vat_percent.$karat"] = 'nullable|numeric|min:0';
        }

        foreach (GoldServiceSetting::pluck('id') as $serviceId) {
            $rules["services.$serviceId.weight_threshold"] = 'required|numeric|min:0.001';
            $rules["services.$serviceId.above_weight_threshold"] = "required|numeric|min:0.001|same:services.$serviceId.weight_threshold";
            $rules["services.$serviceId.light_oc_final_per_article"] = 'required|numeric|min:0';
            $rules["services.$serviceId.heavy_oc_final_per_gram"] = 'required|numeric|min:0';
        }

        $validated = $request->validate($rules);

        foreach ($karats as $karat) {
            $goldRate = $request->input("gold_rate.$karat", 0);
            $vat = $request->input("vat_percent.$karat", 4);
            $active = $request->boolean("is_active.$karat");

            GoldRateSetting::updateOrCreate(
                ['karat' => $karat],
                [
                    'gold_rate_per_gram' => $goldRate,
                    'vat_percent' => $vat,
                    'is_active' => $active,
                ]
            );
        }

        foreach (GoldServiceSetting::all() as $service) {
            $serviceValues = $validated['services'][$service->id];
            unset($serviceValues['above_weight_threshold']);

            $service->update([
                ...$serviceValues,
                'is_active' => $request->boolean("service_active.{$service->id}"),
            ]);
        }

        return redirect()
            ->route('admin.gold-rates.index')
            ->with('success', 'Gold rates and jewellery services updated successfully.');
    }
}
