<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gold_rate_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('gold_rate_settings', 'market')) {
                $table->string('market', 10)->default('pk')->after('id');
            }
        });

        Schema::table('gold_service_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('gold_service_settings', 'market')) {
                $table->string('market', 10)->default('pk')->after('id');
            }
        });

        DB::table('gold_rate_settings')->where(function ($query) {
            $query->whereNull('market')->orWhere('market', '');
        })->update(['market' => 'pk']);

        DB::table('gold_service_settings')->where(function ($query) {
            $query->whereNull('market')->orWhere('market', '');
        })->update(['market' => 'pk']);

        $this->dropUniqueIfExists('gold_rate_settings', ['karat'], 'gold_rate_settings_karat_unique');
        $this->dropUniqueIfExists('gold_service_settings', ['slug'], 'gold_service_settings_slug_unique');

        Schema::table('gold_rate_settings', function (Blueprint $table) {
            $table->unique(['karat', 'market'], 'gold_rate_settings_karat_market_unique');
        });

        Schema::table('gold_service_settings', function (Blueprint $table) {
            $table->unique(['slug', 'market'], 'gold_service_settings_slug_market_unique');
        });

        $pkRates = DB::table('gold_rate_settings')->where('market', 'pk')->get();
        foreach ($pkRates as $rate) {
            $exists = DB::table('gold_rate_settings')
                ->where('karat', $rate->karat)
                ->where('market', 'uae')
                ->exists();

            if (! $exists) {
                DB::table('gold_rate_settings')->insert([
                    'market' => 'uae',
                    'karat' => $rate->karat,
                    'gold_rate_per_gram' => $rate->gold_rate_per_gram,
                    'vat_percent' => $rate->vat_percent,
                    'is_active' => $rate->is_active,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $pkServices = DB::table('gold_service_settings')->where('market', 'pk')->get();
        foreach ($pkServices as $service) {
            $exists = DB::table('gold_service_settings')
                ->where('slug', $service->slug)
                ->where('market', 'uae')
                ->exists();

            if (! $exists) {
                DB::table('gold_service_settings')->insert([
                    'market' => 'uae',
                    'name' => $service->name,
                    'slug' => $service->slug,
                    'weight_threshold' => $service->weight_threshold,
                    'sale_weight_threshold' => $service->sale_weight_threshold ?? $service->weight_threshold,
                    'light_oc_final_per_article' => $service->light_oc_final_per_article,
                    'sale_light_oc_final_per_article' => $service->sale_light_oc_final_per_article ?? $service->light_oc_final_per_article,
                    'heavy_oc_final_per_gram' => $service->heavy_oc_final_per_gram,
                    'sale_heavy_oc_final_per_gram' => $service->sale_heavy_oc_final_per_gram ?? $service->heavy_oc_final_per_gram,
                    'sort_order' => $service->sort_order,
                    'is_active' => $service->is_active,
                    'is_sale' => $service->is_sale ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('gold_rate_settings')->where('market', 'uae')->delete();
        DB::table('gold_service_settings')->where('market', 'uae')->delete();

        $this->dropUniqueIfExists('gold_rate_settings', ['karat', 'market'], 'gold_rate_settings_karat_market_unique');
        $this->dropUniqueIfExists('gold_service_settings', ['slug', 'market'], 'gold_service_settings_slug_market_unique');

        Schema::table('gold_rate_settings', function (Blueprint $table) {
            if (Schema::hasColumn('gold_rate_settings', 'market')) {
                $table->dropColumn('market');
            }
            $table->unique('karat');
        });

        Schema::table('gold_service_settings', function (Blueprint $table) {
            if (Schema::hasColumn('gold_service_settings', 'market')) {
                $table->dropColumn('market');
            }
            $table->unique('slug');
        });
    }

    private function dropUniqueIfExists(string $table, array $columns, string $indexName): void
    {
        try {
            Schema::table($table, function (Blueprint $blueprint) use ($indexName) {
                $blueprint->dropUnique($indexName);
            });
        } catch (\Throwable $e) {
            try {
                Schema::table($table, function (Blueprint $blueprint) use ($columns) {
                    $blueprint->dropUnique($columns);
                });
            } catch (\Throwable $ignored) {
                // Index may already be absent.
            }
        }
    }
};
