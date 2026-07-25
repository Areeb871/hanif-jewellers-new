<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('solitaire_products')->update([
            'diamond_carats' => json_encode($this->newCarats()),
            'default_diamond_carat' => '0.50',
        ]);
    }

    public function down(): void
    {
        DB::table('solitaire_products')->update([
            'diamond_carats' => json_encode([
                ['label' => '0.25', 'value' => '0.25'],
                ['label' => '0.30', 'value' => '0.30'],
                ['label' => '0.40', 'value' => '0.40'],
                ['label' => '0.60', 'value' => '0.60'],
                ['label' => '0.70', 'value' => '0.70'],
                ['label' => '0.75', 'value' => '0.75'],
                ['label' => '0.90', 'value' => '0.90'],
                ['label' => '1', 'value' => '1.00'],
            ]),
            'default_diamond_carat' => '0.25',
        ]);
    }

    private function newCarats(): array
    {
        return [
            ['label' => '0.5', 'value' => '0.50'],
            ['label' => '0.6', 'value' => '0.60'],
            ['label' => '0.7', 'value' => '0.70'],
            ['label' => '0.75', 'value' => '0.75'],
            ['label' => '0.9', 'value' => '0.90'],
            ['label' => '1', 'value' => '1.00'],
        ];
    }
};
