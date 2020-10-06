<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditClolumnDescriptionsToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'descriptions')) {
                $table->String('descriptions')->nullable()->comment('mô tả')->change();
            }
            if (Schema::hasColumn('categories', 'parent_id')) {
                $table->String('parent_id')->nullable()->comment('id danh mục cha')->change();
            }
            if (Schema::hasColumn('categories', 'is_active')) {
                $table->String('is_active')->default(1)->comment('trạng thái')->change();
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'descriptions')) {
                $table->dropColumn('descriptions');
            }
            if (Schema::hasColumn('categories', 'parent_id')) {
                $table->dropColumn('parent_id');
            }
            if (Schema::hasColumn('categories', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
}
