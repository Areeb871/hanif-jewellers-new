<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gold_service_settings', function (Blueprint $table) {
            $table->decimal('sale_weight_threshold', 8, 3)->default(0)->after('weight_threshold');
            $table->decimal('sale_light_oc_final_per_article', 12, 2)->default(0)->after('light_oc_final_per_article');
            $table->decimal('sale_heavy_oc_final_per_gram', 12, 2)->default(0)->after('heavy_oc_final_per_gram');
            $table->boolean('is_sale')->default(false)->after('is_active');
        });

        // Start sale values at the regular values so enabling a sale before editing
        // the new columns can never accidentally produce a zero-charge price.
        DB::table('gold_service_settings')->update([
            'sale_weight_threshold' => DB::raw('weight_threshold'),
            'sale_light_oc_final_per_article' => DB::raw('light_oc_final_per_article'),
            'sale_heavy_oc_final_per_gram' => DB::raw('heavy_oc_final_per_gram'),
        ]);
    }

    public function down(): void
    {
        Schema::table('gold_service_settings', function (Blueprint $table) {
            $table->dropColumn([
                'sale_weight_threshold',
                'sale_light_oc_final_per_article',
                'sale_heavy_oc_final_per_gram',
                'is_sale',
            ]);
        });
    }
};
