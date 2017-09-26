<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->string('name');
            $table->string('avatar')->default('/style/home/icon/portrait.jpg');
            $table->string('email')->unique();
            $table->string('introduce');
            $table->integer('type')->default(0); //类型
            $table->string('phone');
            $table->string('password');
            $table->integer('status')->default(1); //是否可预约：0不可预约，1为可预约
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managers');
    }
}
