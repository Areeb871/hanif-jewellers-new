<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\WatchPricingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WatchPricingController extends Controller
{
    public function index()
    {
        $watchCategory = $this->watchCategory();
        $subcategories = $watchCategory
            ? $watchCategory->subcategories()
                ->with('watchPricingSetting')
                ->orderBy('name')
                ->get()
            : collect();

        return view('admin.watch_pricing.index', compact('subcategories'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => ['nullable', 'array'],
            'settings.*' => ['array:chf_rate,discount_value,sale_discount_value,gst_percent,is_sale'],
            'settings.*.chf_rate' => ['nullable', 'numeric', 'min:0'],
            'settings.*.discount_value' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'settings.*.sale_discount_value' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'settings.*.gst_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'settings.*.is_sale' => ['nullable', 'boolean'],
        ]);

        $watchCategory = $this->watchCategory();
        abort_unless($watchCategory, 404, 'Watches category not found.');

        $settings = $validated['settings'] ?? [];
        $subcategories = $watchCategory->subcategories()->get(['id']);

        foreach ($subcategories as $subcategory) {
            $values = $settings[$subcategory->id] ?? null;
            if (!is_array($values)) {
                continue;
            }

            $isSale = filter_var($values['is_sale'] ?? false, FILTER_VALIDATE_BOOLEAN);
            $normalDiscount = (float) ($values['discount_value'] ?? 0);
            $saleDiscount = (float) ($values['sale_discount_value'] ?? 0);

            if ($isSale && $saleDiscount <= $normalDiscount) {
                throw ValidationException::withMessages([
                    "settings.{$subcategory->id}.sale_discount_value" =>
                        'Sale discount must be greater than the normal discount while sale is enabled.',
                ]);
            }
        }

        DB::transaction(function () use ($settings, $subcategories): void {
            foreach ($subcategories as $subcategory) {
                $values = $settings[$subcategory->id] ?? null;
                if (!is_array($values)) {
                    continue;
                }

                WatchPricingSetting::updateOrCreate(
                    ['subcategory_id' => $subcategory->id],
                    [
                        'chf_rate' => $values['chf_rate'] ?? 0,
                        'discount_value' => $values['discount_value'] ?? 0,
                        'sale_discount_value' => $values['sale_discount_value'] ?? 0,
                        'is_sale' => filter_var(
                            $values['is_sale'] ?? false,
                            FILTER_VALIDATE_BOOLEAN
                        ),
                        'gst_percent' => $values['gst_percent'] ?? 0,
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.watch-pricing.index')
            ->with('success', 'Watch pricing settings updated successfully.');
    }

    private function watchCategory(): ?Categories
    {
        return Categories::where('slug', 'watches')->first()
            ?? Categories::where('name', 'like', '%watch%')->first();
    }
}
