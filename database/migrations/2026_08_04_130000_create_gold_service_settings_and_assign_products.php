<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gold_service_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('weight_threshold', 8, 3);
            $table->decimal('light_oc_final_per_article', 12, 2);
            $table->decimal('heavy_oc_final_per_gram', 12, 2);
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $now = now();
        DB::table('gold_service_settings')->insert([
            self::service('Classic Jewellery', 'classic', 7.000, 10000, 500, 1, $now),
            self::service('Fine Jewellery', 'fine', 4.700, 10000, 800, 2, $now),
            self::service('High End Jewellery', 'high-end', 3.500, 15000, 1000, 3, $now),
            self::service('Exclusive Jewellery', 'exclusive', 2.800, 15000, 1200, 4, $now),
            self::service('Hand Crafted Jewellery', 'hand-crafted', 2.800, 20000, 1500, 5, $now),
        ]);

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('gold_service_id')->nullable()->index()->after('gold_weight');
        });

        $fineServiceId = DB::table('gold_service_settings')->where('slug', 'fine')->value('id');
        DB::table('products')->whereNull('gold_service_id')->update(['gold_service_id' => $fineServiceId]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('gold_service_id');
        });

        Schema::dropIfExists('gold_service_settings');
    }

    private static function service(
        string $name,
        string $slug,
        float $threshold,
        float $lightFinal,
        float $heavyFinal,
        int $sortOrder,
        $now
    ): array {
        return [
            'name' => $name,
            'slug' => $slug,
            'weight_threshold' => $threshold,
            'light_oc_final_per_article' => $lightFinal,
            'heavy_oc_final_per_gram' => $heavyFinal,
            'sort_order' => $sortOrder,
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
};
