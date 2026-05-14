<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerTypeToSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_categories', 'banner_type')) {
                $table->string('banner_type')->nullable()->after('slug'); // Adjust position as needed
            }
        });
    }

    public function down()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn('banner_type');
        });
    }
}
