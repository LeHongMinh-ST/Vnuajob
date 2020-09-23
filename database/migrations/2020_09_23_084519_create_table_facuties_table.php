<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFacutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facuties', function (Blueprint $table) {
            $table->id();
            $table->string('facuty_code')->comment('Mã khoa');
            $table->string('name')->comment('Tên khoa');
            $table->string('descriptions')->nullable()->comment('Mô tả');
            $table->tinyInteger('is_active')->comment('0:chưa kích hoạt - 1:Đã kích hoạt');
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
        Schema::dropIfExists('facuties');
    }
}
