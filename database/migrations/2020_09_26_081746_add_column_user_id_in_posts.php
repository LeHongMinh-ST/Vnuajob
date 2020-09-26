<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserIdInPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'user_created_id')) {
                $table->integer('user_created_id')->nullable()->comment('id người tạo');
            }
            if (!Schema::hasColumn('posts', 'user_created_table')) {
                $table->integer('user_created_table')->nullable()->comment('bảng người tạo, 1 là admin, 0 là nhà tuyển dụng');
            }
            if (!Schema::hasColumn('posts', 'slug')) {
                $table->String('slug')->nullable();
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
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'user_created_id')) {
                $table->dropColumn('user_created_id');
            }
            if (Schema::hasColumn('posts', 'user_created_table')) {
                $table->dropColumn('user_created_table');
            }
            if (Schema::hasColumn('posts', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
}
