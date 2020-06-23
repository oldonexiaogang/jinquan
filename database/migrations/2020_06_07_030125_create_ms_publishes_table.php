<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsPublishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_publishes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->decimal('price',10,2)->default(100)->comment('女神自主价格');
            $table->decimal('platform_price',10,2)->default(100)->comment('平台定价');
            $table->boolean('is_abutment')->default(false)->comment('对接状态');
            $table->boolean('is_show')->default(true)->comment('是否接单');
            $table->boolean('status')->default(false)->comment('是否通过平台审核');
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
        Schema::dropIfExists('ms_publishes');
    }
}
