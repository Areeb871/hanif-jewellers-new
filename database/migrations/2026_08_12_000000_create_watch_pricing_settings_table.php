<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('watch_pricing_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')
                ->unique()
                ->constrained('sub_categories')
                ->cascadeOnDelete();
            $table->decimal('chf_rate', 15, 4)->default(0);
            $table->decimal('discount_value', 15, 2)->default(0);
            $table->decimal('gst_percent', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watch_pricing_settings');
    }
};
