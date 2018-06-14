<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link',function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->comment('//名称');
            $table->string('description')->comment('//描述');
            $table->integer('order')->default(0)->comment('//排序');
            $table->string('url')->comment('//链接');
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
        Schema::drop('link');
    }
}
