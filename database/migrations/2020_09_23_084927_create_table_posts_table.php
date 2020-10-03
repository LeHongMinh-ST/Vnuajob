<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('tiêu đề bài đăng');
            $table->string('descriptions')->comment('mô tả');
            $table->string('content')->comment('nội dung');
            $table->date('date_public')->comment('Ngày tuyển dụng công khai');
            $table->string('vacancy')->comment('số lượng tuyển dụng');
            $table->string('salary')->comment('tiền lương');
            $table->string('location')->comment('địa chỉ làm việc');
            $table->string('job_nature')->comment('tính chất công việc');
            $table->bigInteger('category_id')->comment('id bảng category');
            $table->bigInteger('company_id')->comment('id bảng company');
            $table->tinyInteger('status')->comment('0:chưa đủ số lượng tuyển dụng - 1:đã đủ số lượng tuyển dụng');
            $table->tinyInteger('is_active')->comment('0:chưa kích hoạt - 1:đã kích hoạt');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
