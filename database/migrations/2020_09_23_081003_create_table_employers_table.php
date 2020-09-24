<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('tên người tuyển dụng');
            $table->string('phone')->nullable()->comment('số điện thoại');
            $table->string('email')->unique()->comment('email người dùng');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('title')->nullable()->comment('chức vụ');
            $table->date('birthday')->nullable()->comment('ngày sinh');
            $table->bigInteger('company_id')->nullable()->comment('id bảng công ty');
            $table->tinyInteger('is_active')->default(0)->comment('0:ngừng kích hoạt - 1:kích hoạt');
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
        Schema::dropIfExists('employers');
    }
}
