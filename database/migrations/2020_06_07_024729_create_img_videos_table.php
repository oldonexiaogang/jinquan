<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->enum('type',['img','video'])->default('img');
            $table->text('url');
            $table->boolean('is_show')->default(true)->comment('是否显示');
            $table->integer('view_count')->default(0)->comment('查看总数');
            $table->integer('zan_count')->default(0)->comment('点赞数');
            $table->boolean('status')->default(0)->comment('是否审核通过');
            $table->softDeletes();
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
        Schema::dropIfExists('img_videos');
    }
}
