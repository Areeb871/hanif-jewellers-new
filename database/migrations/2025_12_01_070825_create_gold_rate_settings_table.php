<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gold_rate_settings', function (Blueprint $table) {
            $table->id();
            // 18, 21, 22, 24 etc.
            $table->unsignedTinyInteger('karat')->unique();
            // Base gold rate per gram for this karat
            $table->decimal('gold_rate_per_gram', 10, 2)->default(0);
            // Making charges per gram
            $table->decimal('making_charges_per_gram', 10, 2)->default(0);
            // VAT / additional percentage (e.g. 4%)
            $table->decimal('vat_percent', 5, 2)->default(4.00);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gold_rate_settings');
    }
};
