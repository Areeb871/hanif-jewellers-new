<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $columns = [
            'light_wastage_grams',
            'heavy_wastage_percent',
            'light_oc_asking_per_article',
            'heavy_oc_asking_per_gram',
        ];

        $existingColumns = array_values(array_filter(
            $columns,
            fn (string $column) => Schema::hasColumn('gold_service_settings', $column)
        ));

        if ($existingColumns !== []) {
            Schema::table('gold_service_settings', function (Blueprint $table) use ($existingColumns) {
                $table->dropColumn($existingColumns);
            });
        }
    }

    public function down(): void
    {
        Schema::table('gold_service_settings', function (Blueprint $table) {
            $table->decimal('light_wastage_grams', 8, 3)->default(0.700);
            $table->decimal('heavy_wastage_percent', 5, 2)->default(0);
            $table->decimal('light_oc_asking_per_article', 12, 2)->default(0);
            $table->decimal('heavy_oc_asking_per_gram', 12, 2)->default(0);
        });

        $values = [
            'classic' => [10, 20000, 1000],
            'fine' => [15, 20000, 1600],
            'high-end' => [20, 30000, 2000],
            'exclusive' => [25, 30000, 2400],
            'hand-crafted' => [25, 40000, 3000],
        ];

        foreach ($values as $slug => [$wastage, $lightAsking, $heavyAsking]) {
            DB::table('gold_service_settings')->where('slug', $slug)->update([
                'heavy_wastage_percent' => $wastage,
                'light_oc_asking_per_article' => $lightAsking,
                'heavy_oc_asking_per_gram' => $heavyAsking,
            ]);
        }
    }
};
