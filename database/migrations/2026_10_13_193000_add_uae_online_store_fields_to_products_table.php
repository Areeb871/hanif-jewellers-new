<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'uae_online_store_name')) {
                $table->string('uae_online_store_name')->nullable()->after('online_store_name');
            }
            if (! Schema::hasColumn('products', 'uae_online_store_description')) {
                $table->longText('uae_online_store_description')->nullable()->after('online_store_description');
            }
            if (! Schema::hasColumn('products', 'online_store_price')) {
                $table->decimal('online_store_price', 12, 2)->nullable()->after('price');
            }
            if (! Schema::hasColumn('products', 'online_store_price_aed')) {
                $table->decimal('online_store_price_aed', 12, 2)->nullable()->after('price_aed');
            }
            if (! Schema::hasColumn('products', 'online_store_diamond_price')) {
                $table->decimal('online_store_diamond_price', 12, 2)->nullable()->after('diamond_price');
            }
            if (! Schema::hasColumn('products', 'uae_online_store_diamond_price')) {
                $table->decimal('uae_online_store_diamond_price', 12, 2)->nullable()->after('uae_diamond_price');
            }
            if (! Schema::hasColumn('products', 'online_store_gold_weight')) {
                $table->decimal('online_store_gold_weight', 8, 3)->nullable()->after('gold_weight');
            }
            if (! Schema::hasColumn('products', 'uae_online_store_gold_weight')) {
                $table->decimal('uae_online_store_gold_weight', 8, 3)->nullable()->after('uae_gold_weight');
            }
            if (! Schema::hasColumn('products', 'online_store_gold_service_id')) {
                $table->unsignedBigInteger('online_store_gold_service_id')->nullable()->after('gold_service_id');
                $table->foreign('online_store_gold_service_id')
                    ->references('id')
                    ->on('gold_service_settings')
                    ->nullOnDelete();
            }
            if (! Schema::hasColumn('products', 'uae_online_store_gold_service_id')) {
                $table->unsignedBigInteger('uae_online_store_gold_service_id')->nullable()->after('uae_gold_service_id');
                $table->foreign('uae_online_store_gold_service_id')
                    ->references('id')
                    ->on('gold_service_settings')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            foreach (['online_store_gold_service_id', 'uae_online_store_gold_service_id'] as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropForeign([$column]);
                    $table->dropColumn($column);
                }
            }

            foreach ([
                'uae_online_store_name',
                'uae_online_store_description',
                'online_store_price',
                'online_store_price_aed',
                'online_store_diamond_price',
                'uae_online_store_diamond_price',
                'online_store_gold_weight',
                'uae_online_store_gold_weight',
            ] as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
