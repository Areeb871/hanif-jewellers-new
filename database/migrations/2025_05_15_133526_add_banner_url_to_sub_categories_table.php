<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerUrlToSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_categories', 'banner_url')) {
                $table->string('banner_url')->nullable()->after('banner_type');
            }
        });
    }

    public function down()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn('banner_url');
        });
    }
}
