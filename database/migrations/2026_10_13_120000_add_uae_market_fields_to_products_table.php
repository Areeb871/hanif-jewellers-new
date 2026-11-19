<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'uae_name')) {
                $table->string('uae_name')->nullable()->after('name');
            }
            if (! Schema::hasColumn('products', 'uae_description')) {
                $table->longText('uae_description')->nullable()->after('description');
            }
            if (! Schema::hasColumn('products', 'uae_diamond_price')) {
                $table->decimal('uae_diamond_price', 12, 2)->nullable()->after('diamond_price');
            }
            if (! Schema::hasColumn('products', 'uae_gold_weight')) {
                $table->decimal('uae_gold_weight', 8, 3)->nullable()->after('gold_weight');
            }
            if (! Schema::hasColumn('products', 'uae_gold_service_id')) {
                $table->unsignedBigInteger('uae_gold_service_id')->nullable()->after('gold_service_id');
                $table->foreign('uae_gold_service_id')
                    ->references('id')
                    ->on('gold_service_settings')
                    ->nullOnDelete();
            }
            if (! Schema::hasColumn('products', 'price_aed')) {
                $table->decimal('price_aed', 12, 2)->nullable()->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'uae_gold_service_id')) {
                $table->dropForeign(['uae_gold_service_id']);
                $table->dropColumn('uae_gold_service_id');
            }
            foreach (['uae_name', 'uae_description', 'uae_diamond_price', 'uae_gold_weight'] as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
