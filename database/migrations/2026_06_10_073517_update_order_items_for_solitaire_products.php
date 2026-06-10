<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'product_id')) {
                $table->unsignedBigInteger('product_id')->nullable()->change();
            }

            if (!Schema::hasColumn('order_items', 'solitaire_product_id')) {
                $table->unsignedBigInteger('solitaire_product_id')->nullable()->after('product_id');
            }

            if (!Schema::hasColumn('order_items', 'cart_type')) {
                $table->string('cart_type')->default('normal')->after('solitaire_product_id');
            }

            if (!Schema::hasColumn('order_items', 'metal_code')) {
                $table->string('metal_code')->nullable()->after('cart_type');
            }

            if (!Schema::hasColumn('order_items', 'metal_name')) {
                $table->string('metal_name')->nullable()->after('metal_code');
            }

            if (!Schema::hasColumn('order_items', 'diamond_carat')) {
                $table->decimal('diamond_carat', 4, 2)->nullable()->after('metal_name');
            }

            if (!Schema::hasColumn('order_items', 'solitaire_ring_size')) {
                $table->string('solitaire_ring_size')->nullable()->after('diamond_carat');
            }

            if (!Schema::hasColumn('order_items', 'inscription_text')) {
                $table->text('inscription_text')->nullable()->after('solitaire_ring_size');
            }

            if (!Schema::hasColumn('order_items', 'selected_image')) {
                $table->string('selected_image')->nullable()->after('inscription_text');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'selected_image')) {
                $table->dropColumn('selected_image');
            }

            if (Schema::hasColumn('order_items', 'inscription_text')) {
                $table->dropColumn('inscription_text');
            }

            if (Schema::hasColumn('order_items', 'solitaire_ring_size')) {
                $table->dropColumn('solitaire_ring_size');
            }

            if (Schema::hasColumn('order_items', 'diamond_carat')) {
                $table->dropColumn('diamond_carat');
            }

            if (Schema::hasColumn('order_items', 'metal_name')) {
                $table->dropColumn('metal_name');
            }

            if (Schema::hasColumn('order_items', 'metal_code')) {
                $table->dropColumn('metal_code');
            }

            if (Schema::hasColumn('order_items', 'cart_type')) {
                $table->dropColumn('cart_type');
            }

            if (Schema::hasColumn('order_items', 'solitaire_product_id')) {
                $table->dropColumn('solitaire_product_id');
            }
        });
    }
};