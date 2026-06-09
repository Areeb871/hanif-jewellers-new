<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {

            if (!Schema::hasColumn('carts', 'solitaire_product_id')) {
                $table->unsignedBigInteger('solitaire_product_id')->nullable()->after('product_id');
            }

            if (!Schema::hasColumn('carts', 'metal_code')) {
                $table->string('metal_code')->nullable()->after('size');
            }

            if (!Schema::hasColumn('carts', 'metal_name')) {
                $table->string('metal_name')->nullable()->after('metal_code');
            }

            if (!Schema::hasColumn('carts', 'diamond_carat')) {
                $table->decimal('diamond_carat', 5, 2)->nullable()->after('metal_name');
            }

            if (!Schema::hasColumn('carts', 'inscription_text')) {
                $table->string('inscription_text', 15)->nullable()->after('diamond_carat');
            }

            if (!Schema::hasColumn('carts', 'variant_price')) {
                $table->decimal('variant_price', 12, 2)->nullable()->after('inscription_text');
            }

            if (!Schema::hasColumn('carts', 'old_price')) {
                $table->decimal('old_price', 12, 2)->nullable()->after('variant_price');
            }

            if (!Schema::hasColumn('carts', 'discount_percent')) {
                $table->decimal('discount_percent', 5, 2)->nullable()->after('old_price');
            }

            if (!Schema::hasColumn('carts', 'cart_type')) {
                $table->string('cart_type')->default('normal')->after('discount_percent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {

            $columns = [
                'solitaire_product_id',
                'metal_code',
                'metal_name',
                'diamond_carat',
                'inscription_text',
                'variant_price',
                'old_price',
                'discount_percent',
                'cart_type',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('carts', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
