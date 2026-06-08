<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solitaire_products', function (Blueprint $table) {
            if (!Schema::hasColumn('solitaire_products', 'shape')) {
                $table->string('shape')->nullable()->after('short_description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('solitaire_products', function (Blueprint $table) {
            if (Schema::hasColumn('solitaire_products', 'shape')) {
                $table->dropColumn('shape');
            }
        });
    }
};