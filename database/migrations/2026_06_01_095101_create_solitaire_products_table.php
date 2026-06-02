<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solitaire_products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('sku')->nullable();
            $table->string('tag_label')->nullable();
            $table->text('short_description')->nullable();

            $table->string('currency', 10)->default('AED');

            $table->json('gallery_images')->nullable();
            $table->json('metals')->nullable();
            $table->json('diamond_carats')->nullable();
            $table->json('metal_images')->nullable();
            $table->json('variants')->nullable();

            $table->string('default_metal_code')->nullable();
            $table->string('default_diamond_carat')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solitaire_products');
    }
};