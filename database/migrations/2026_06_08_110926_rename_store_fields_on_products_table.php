<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('products', 'store_name') && !Schema::hasColumn('products', 'online_store_name')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('store_name', 'online_store_name');
            });
        }

        if (Schema::hasColumn('products', 'store_description') && !Schema::hasColumn('products', 'online_store_description')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('store_description', 'online_store_description');
            });
        }

        if (!Schema::hasColumn('products', 'online_store_name')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('online_store_name')->nullable()->after('name');
            });
        }

        if (!Schema::hasColumn('products', 'online_store_description')) {
            Schema::table('products', function (Blueprint $table) {
                $table->longText('online_store_description')->nullable()->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'online_store_name') && !Schema::hasColumn('products', 'store_name')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('online_store_name', 'store_name');
            });
        }

        if (Schema::hasColumn('products', 'online_store_description') && !Schema::hasColumn('products', 'store_description')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('online_store_description', 'store_description');
            });
        }
    }
};
