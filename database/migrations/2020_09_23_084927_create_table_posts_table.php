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
            $table->string('descriptions')->nullable()->comment('mô tả');
            $table->string('content')->comment('nội dung');
            $table->date('date_public')->nullable()->comment('Ngày tuyển dụng công khai');
            $table->string('vacancy')->comment('số lượng tuyển dụng');
            $table->string('salary')->comment('tiền lương');
            $table->string('location')->nullable()->comment('địa chỉ làm việc');
            $table->integer('job_nature')->nullable()->comment('tính chất công việc 1: partime, 2 fulltime, 3 cả 2');
            $table->bigInteger('user_id')->comment('id người tạo');
            $table->tinyInteger('user_table')->default(0)->comment('bảng người tạo 0: admin; 1:company');
            $table->bigInteger('category_id')->comment('id bảng category');
            $table->bigInteger('company_id')->comment('id bảng company');
            $table->tinyInteger('status')->default(0)->comment('0:chưa đủ số lượng tuyển dụng - 1:đã đủ số lượng tuyển dụng');
            $table->tinyInteger('is_active')->default(1)->comment('0:chưa kích hoạt - 1:đã kích hoạt');
            $table->integer('salart_start')->nullable()->comment('tiền lương bắt đầu, bằng số, đơn vị vnd');
            $table->integer('salart_end')->nullable()->comment('tiền lương kết thúc, bằng số, đơn vị vnd');
            $table->integer('request_degree')->default(0)->comment('yêu cầu bằng cấp. 1 là có, 0 là không');
            $table->integer('request_old')->default(0)->comment('yêu cầu độ tuổi. 1 là có, 0 là không');
            $table->text('request_experience')->default(0)->comment('yêu cầu kinh nghiệm');
            $table->integer('request_sex')->default(0)->comment('yêu cầu giới tính. 1 là nam, 2 là nữ, 0 là không');
            $table->text('position')->default('Nhân viên')->comment('chức vụ');
            $table->timestamp('deadline')->nullable()->comment('hạn nộp hồ sơ');
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
