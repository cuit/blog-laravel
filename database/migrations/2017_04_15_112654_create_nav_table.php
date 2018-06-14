<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav',function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->comment('//自定义导航栏名称');
            $table->string('alias')->comment('//导航栏别名');
            $table->string('url')->comment('//导航栏地址');
            $table->integer('order')->default(0)->comment('//导航栏排序');
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
        Schema::drop('nav');
    }
}
