<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'online_store_name')) {
                $table->string('online_store_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('products', 'online_store_description')) {
                $table->longText('online_store_description')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'online_store_name')) {
                $table->dropColumn('online_store_name');
            }
            if (Schema::hasColumn('products', 'online_store_description')) {
                $table->dropColumn('online_store_description');
            }
        });
    }
};
