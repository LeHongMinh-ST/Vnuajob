<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('tên sinh viên');
            $table->string('student_code')->nullable()->comment('mã sinh viên');
            $table->string('phone')->nullable()->comment('số điện thoại');
            $table->string('home_town')->nullable()->comment('quê quán');
            $table->string('class')->nullable()->comment('lớp');
            $table->bigInteger('user_id')->nullable()->comment('id bảng người dùng');
            $table->bigInteger('facuty_id')->nullable()->comment('id bảng người dùng');
            $table->bigInteger('status')->default(0)->comment('Trạng thái việc làm sinh viên: 0:chưa tìm được - 1:đã tìm được việc');
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
        Schema::dropIfExists('students');
    }
}
