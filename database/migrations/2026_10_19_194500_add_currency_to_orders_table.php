<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('orders', 'currency')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('currency', 3)->default('PKR')->after('payment_method');
            });
        }

        $emirates = [
            'Abu Dhabi',
            'Dubai',
            'Sharjah',
            'Ras Al Khaimah',
            'Fujairah',
            'Umm Al Quwain',
            'Ajman',
        ];

        DB::table('orders')
            ->where(function ($query) use ($emirates) {
                $query->where('payment_method', 'contact')
                    ->orWhereIn('state', $emirates);
            })
            ->update(['currency' => 'AED']);
    }

    public function down(): void
    {
        if (Schema::hasColumn('orders', 'currency')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('currency');
            });
        }
    }
};
