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
        if (Schema::hasTable('orders')) {
            return;
        }

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Order Information
            $table->string('order_number')->unique();
            $table->enum('status', ['pending', 'payment_verified', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            
            // Customer Information
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            
            // Shipping Information
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('delivery_option')->default('shipItems');
            
            // Payment Information
            $table->string('payment_method');
            $table->string('payment_receipt')->nullable();
            $table->enum('payment_status', ['pending', 'verified', 'failed'])->default('pending');
            $table->text('order_notes')->nullable();
            
            // Order Totals
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            
            // Timestamps
            $table->timestamps();
            // Indexes
            $table->index(['user_id', 'session_id']);
            $table->index('order_number');
            $table->index('status');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
