<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsTrafficInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_traffic_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ms_user_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('ms_publish_id');
            $table->enum('transportation',['airplane','high_speed_railway','taxi','other'])->default('taxi');
            $table->string('code')->comment('班次');
            $table->text('img')->comment('图片')->nullable();
            $table->decimal('money',10,2)->default(1);
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
        Schema::dropIfExists('ms_traffic_infos');
    }
}
