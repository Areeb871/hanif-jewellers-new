<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solitaire_products', function (Blueprint $table) {
            $table->string('uae_name')->nullable()->after('name');
            $table->string('uae_tag_label')->nullable()->after('tag_label');
            $table->text('uae_short_description')->nullable()->after('short_description');
        });
    }

    public function down(): void
    {
        Schema::table('solitaire_products', function (Blueprint $table) {
            $table->dropColumn(['uae_name', 'uae_tag_label', 'uae_short_description']);
        });
    }
};
