<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiamondRateSetting;
use Illuminate\Http\Request;

class DiamondRateController extends Controller
{
    /**
     * Show and edit diamond rate settings for 18k, 21k, 22k, 24k.
     */
    public function index()
    {
        $karats = [18, 21, 22, 24];

        $settings = DiamondRateSetting::whereIn('karat', $karats)
            ->get()
            ->keyBy('karat');

        foreach ($karats as $karat) {
            if (!isset($settings[$karat])) {
                $settings[$karat] = new DiamondRateSetting([
                    'karat' => $karat,
                    'rate_per_carat' => 0,
                    'making_charge' => 0,
                    'gst_percent' => 4,
                    'dollar_rate' => 0,
                    'discount_percent' => 0,
                    'is_active' => true,
                ]);
            }
        }

        return view('admin.diamond_rates.index', [
            'settings' => $settings,
            'karats' => $karats,
        ]);
    }

    /**
     * Store/update diamond rate settings.
     */
    public function update(Request $request)
    {
        $karats = [18, 21, 22, 24];

        foreach ($karats as $karat) {
            $request->validate([
                "rate_per_carat.$karat" => 'nullable|numeric|min:0',
                "making_charge.$karat" => 'nullable|numeric|min:0',
                "gst_percent.$karat" => 'nullable|numeric|min:0',
                "dollar_rate.$karat" => 'nullable|numeric|min:0',
                "discount_percent.$karat" => 'nullable|numeric|min:0',
            ]);

            DiamondRateSetting::updateOrCreate(
                ['karat' => $karat],
                [
                    'rate_per_carat' => $request->input("rate_per_carat.$karat", 0),
                    'making_charge' => $request->input("making_charge.$karat", 0),
                    'gst_percent' => $request->input("gst_percent.$karat", 4),
                    'dollar_rate' => $request->input("dollar_rate.$karat", 0),
                    'discount_percent' => $request->input("discount_percent.$karat", 0),
                    'is_active' => $request->has("is_active.$karat"),
                ]
            );
        }

        return redirect()
            ->route('admin.diamond-rates.index')
            ->with('success', 'Diamond rates updated successfully.');
    }
}
