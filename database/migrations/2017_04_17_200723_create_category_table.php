<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories',function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->comment('//分类名称');
            $table->string('title')->comment('//分类名称辅助名称');
            $table->string('keywords')->comment('//分类关键词');
            $table->string('description')->comment('//描述');
            $table->integer('view')->comment('//点击次数');
            $table->integer('order')->default(0)->comment('//分类排序');
            $table->integer('pid')->comment('//父类id');
            $table->string('icon')->default('store')->comment('//图标');
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
        Schema::drop('categories');
    }
}
