<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'price_pkr')) {
                $table->decimal('price_pkr', 10, 2)->after('price')->default(0);
            }
        });

        if (Schema::hasColumn('products', 'price_pkr')) {
            DB::table('products')
                ->whereNull('price_pkr')
                ->orWhere('price_pkr', 0)
                ->update([
                    'price_pkr' => DB::raw('COALESCE(price, 0)')
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'price_pkr')) {
                $table->dropColumn('price_pkr');
            }
        });
    }
};

