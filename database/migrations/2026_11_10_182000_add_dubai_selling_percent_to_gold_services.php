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
            if (! Schema::hasColumn('gold_service_settings', 'selling_percent')) {
                $table->decimal('selling_percent', 5, 2)->nullable()->after('sale_heavy_oc_final_per_gram');
            }
            if (! Schema::hasColumn('gold_service_settings', 'sale_selling_percent')) {
                $table->decimal('sale_selling_percent', 5, 2)->nullable()->after('selling_percent');
            }
        });

        $percents = [
            'dubai' => 5,
            'classic' => 10,
            'fine' => 15,
            'high-end' => 20,
            'exclusive' => 25,
            'hand-crafted' => 30,
        ];

        $now = now();
        $exists = DB::table('gold_service_settings')
            ->where('market', 'uae')
            ->where('slug', 'dubai')
            ->exists();

        if (! $exists) {
            DB::table('gold_service_settings')->insert([
                'market' => 'uae',
                'name' => 'Dubai Jewellery',
                'slug' => 'dubai',
                'weight_threshold' => 6,
                'sale_weight_threshold' => 6,
                'light_oc_final_per_article' => 0,
                'sale_light_oc_final_per_article' => 0,
                'heavy_oc_final_per_gram' => 0,
                'sale_heavy_oc_final_per_gram' => 0,
                'selling_percent' => $percents['dubai'],
                'sale_selling_percent' => $percents['dubai'],
                'sort_order' => 0,
                'is_active' => true,
                'is_sale' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        foreach ($percents as $slug => $percent) {
            DB::table('gold_service_settings')
                ->where('market', 'uae')
                ->where('slug', $slug)
                ->update([
                    'selling_percent' => $percent,
                    'sale_selling_percent' => $percent,
                    'updated_at' => $now,
                ]);
        }
    }

    public function down(): void
    {
        DB::table('gold_service_settings')
            ->where('market', 'uae')
            ->where('slug', 'dubai')
            ->delete();

        Schema::table('gold_service_settings', function (Blueprint $table) {
            if (Schema::hasColumn('gold_service_settings', 'sale_selling_percent')) {
                $table->dropColumn('sale_selling_percent');
            }
            if (Schema::hasColumn('gold_service_settings', 'selling_percent')) {
                $table->dropColumn('selling_percent');
            }
        });
    }
};
