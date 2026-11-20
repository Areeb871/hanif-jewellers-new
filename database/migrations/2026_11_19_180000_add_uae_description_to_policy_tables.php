<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['privacy_policy', 'refund_policy', 'terms_service', 'shipping_policy'] as $tableName) {
            if (Schema::hasTable($tableName) && ! Schema::hasColumn($tableName, 'uae_description')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->longText('uae_description')->nullable()->after('description');
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['privacy_policy', 'refund_policy', 'terms_service', 'shipping_policy'] as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'uae_description')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('uae_description');
                });
            }
        }
    }
};
