<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'solitaire_ring_size')) {
                $table->string('solitaire_ring_size')->nullable()->after('diamond_carat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'solitaire_ring_size')) {
                $table->dropColumn('solitaire_ring_size');
            }
        });
    }
};