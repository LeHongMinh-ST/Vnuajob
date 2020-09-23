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
            $table->string('title')->nullable()->comment('chức vụ');
            $table->date('birthday')->nullable()->comment('ngày sinh');
            $table->bigInteger('user_id')->comment('id bảng người dùng');
            $table->bigInteger('company_id')->comment('id bảng công ty');
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
