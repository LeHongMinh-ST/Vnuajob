<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('tên công ty');
            $table->string('email')->nullable()->comment('email công ty');
            $table->string('phone')->nullable()->comment('số điện thoại công ty');
            $table->string('address')->nullable()->comment('địa chỉ công ty');
            $table->string('website')->nullable()->comment('trang web công ty');
            $table->text('descriptions')->nullable()->comment('mô tả công ty');
            $table->string('logo')->nullable()->comment('ảnh logo');
            $table->tinyInteger('is_active')->default(1)->comment('0:chưa kích hoạt - 1:Đã kích hoạt');
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
        Schema::dropIfExists('companies');
    }
}
