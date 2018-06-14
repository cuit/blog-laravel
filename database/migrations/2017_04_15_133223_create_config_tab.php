<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config',function (Blueprint $table){
            $table->increments('id');
            $table->string('title')->comment('//配置项标题');
            $table->string('name')->comment('//变量名');
            $table->text('content')->comment('//变量值');
            $table->integer('order')->default(0)->comment('//排序');
            $table->string('tips')->comment('//描述');
            $table->string('filed_type')->comment('//字段类型');
            $table->string('filed_value')->comment('//字段值');
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
        Schema::drop('config');
    }
}
