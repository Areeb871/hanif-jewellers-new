<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('gold_rate_settings', 'making_charges_per_gram')) {
            Schema::table('gold_rate_settings', function (Blueprint $table) {
                $table->dropColumn('making_charges_per_gram');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('gold_rate_settings', 'making_charges_per_gram')) {
            Schema::table('gold_rate_settings', function (Blueprint $table) {
                $table->decimal('making_charges_per_gram', 10, 2)->default(0)->after('gold_rate_per_gram');
            });
        }
    }
};
