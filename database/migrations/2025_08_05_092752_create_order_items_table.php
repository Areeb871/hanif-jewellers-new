<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('order_items')) {
            return;
        }

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // Order Reference
            $table->unsignedBigInteger('order_id');
            
            // Product Information
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->string('product_image')->nullable();
            
            // Pricing Information
            $table->decimal('unit_price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('discount_type')->nullable(); // percentage or fixed
            $table->decimal('discount_percentage', 5, 2)->nullable();
            
            // Quantity and Total
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            
            // Timestamps
            $table->timestamps();
            // Indexes
            $table->index('order_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
