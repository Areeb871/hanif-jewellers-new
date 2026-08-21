<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('watch_pricing_settings', function (Blueprint $table) {
            $table->decimal('sale_discount_value', 15, 2)->default(0);
            $table->boolean('is_sale')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('watch_pricing_settings', function (Blueprint $table) {
            $table->dropColumn(['sale_discount_value', 'is_sale']);
        });
    }
};
