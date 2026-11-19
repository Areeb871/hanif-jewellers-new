<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diamond_rate_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('diamond_rate_settings', 'market')) {
                $table->string('market', 10)->default('pk')->after('id');
            }
        });

        DB::table('diamond_rate_settings')->where(function ($query) {
            $query->whereNull('market')->orWhere('market', '');
        })->update(['market' => 'pk']);

        $this->dropUniqueIfExists('diamond_rate_settings', ['karat'], 'diamond_rate_settings_karat_unique');

        Schema::table('diamond_rate_settings', function (Blueprint $table) {
            $table->unique(['karat', 'market'], 'diamond_rate_settings_karat_market_unique');
        });

        $pkRates = DB::table('diamond_rate_settings')->where('market', 'pk')->get();
        foreach ($pkRates as $rate) {
            $exists = DB::table('diamond_rate_settings')
                ->where('karat', $rate->karat)
                ->where('market', 'uae')
                ->exists();

            if (! $exists) {
                DB::table('diamond_rate_settings')->insert([
                    'market' => 'uae',
                    'karat' => $rate->karat,
                    'rate_per_carat' => $rate->rate_per_carat,
                    'making_charge' => $rate->making_charge,
                    'gst_percent' => $rate->gst_percent,
                    'dollar_rate' => $rate->dollar_rate,
                    'discount_percent' => $rate->discount_percent,
                    'is_active' => $rate->is_active,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('diamond_rate_settings')->where('market', 'uae')->delete();

        $this->dropUniqueIfExists('diamond_rate_settings', ['karat', 'market'], 'diamond_rate_settings_karat_market_unique');

        Schema::table('diamond_rate_settings', function (Blueprint $table) {
            if (Schema::hasColumn('diamond_rate_settings', 'market')) {
                $table->dropColumn('market');
            }
            $table->unique('karat');
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
