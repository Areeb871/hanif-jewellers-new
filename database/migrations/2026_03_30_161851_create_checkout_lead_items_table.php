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
       Schema::create('checkout_lead_items', function (Blueprint $table) {
        $table->id();

        // Checkout Lead Reference
        $table->unsignedBigInteger('checkout_lead_id');

        // Product Information
        $table->unsignedBigInteger('product_id')->nullable();
        $table->string('product_name')->nullable();
        $table->string('product_image')->nullable();

        // Pricing Information
        $table->decimal('unit_price', 10, 2)->nullable();
        $table->decimal('original_price', 10, 2)->nullable();
        $table->decimal('discount_amount', 10, 2)->default(0);
        $table->string('discount_type')->nullable(); // percentage or fixed
        $table->decimal('discount_percentage', 5, 2)->nullable();

        // Quantity and Total
        $table->integer('quantity')->default(1);
        $table->decimal('total_price', 10, 2)->nullable();

        // Timestamps
        $table->timestamps();

        // Indexes
        $table->index('checkout_lead_id');
        $table->index('product_id');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_lead_items');
    }
};
