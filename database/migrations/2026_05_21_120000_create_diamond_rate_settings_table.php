<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('diamond_rate_settings')) {
            return;
        }

        Schema::create('diamond_rate_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('karat')->unique();
            $table->decimal('rate_per_carat', 10, 2)->default(0);
            $table->decimal('making_charge', 10, 2)->default(0);
            $table->decimal('gst_percent', 5, 2)->default(4.00);
            $table->decimal('dollar_rate', 10, 2)->default(0);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diamond_rate_settings');
    }
};
