<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Make product_id nullable
            |--------------------------------------------------------------------------
            | Normal products will use product_id.
            | Solitaire products will keep product_id null and save details in item_options.
            |--------------------------------------------------------------------------
            */
            if (Schema::hasColumn('order_items', 'product_id')) {
                $table->unsignedBigInteger('product_id')->nullable()->change();
            }

            /*
            |--------------------------------------------------------------------------
            | One JSON column for all extra cart data
            |--------------------------------------------------------------------------
            */
            if (!Schema::hasColumn('order_items', 'item_options')) {
                $table->json('item_options')->nullable()->after('product_image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'item_options')) {
                $table->dropColumn('item_options');
            }
        });
    }
};