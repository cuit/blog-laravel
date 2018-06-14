<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles',function (Blueprint $table){
            $table->increments('id');
            $table->string('title')->comment('//标题');
            $table->string('tag')->comment('//新闻标签');
            $table->string('description')->comment('//新闻描述');
            $table->string('cover')->comment('//新闻封面');
            $table->string('thumb')->comment('//缩略图');
            $table->longText('content')->comment('//新闻内容');
            $table->string('editor')->comment('//新闻编辑者');
            $table->integer('view')->comment('//浏览次数');
            $table->integer('cate_id')->comment('//新闻类别');
            $table->enum('recommend',['0','1'])->comment('//是否推荐');
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
        Schema::drop('articles');
    }
}
