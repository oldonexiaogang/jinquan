<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMrOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mr_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mr_user_id');
            $table->unsignedBigInteger('ms_user_id');
            $table->unsignedBigInteger('ms_publish_id');
            $table->decimal('total_amount',10,2)->default(100)->comment('总金额');
            $table->decimal('amount',10,2)->default(100)->comment('已付款');
            $table->integer('days')->default(1);
            $table->enum('status',['ms_unconfirmed','established','complete','appeal'])->default('ms_unconfirmed');
            $table->text('review')->nullable();
            $table->enum('rating',['good','bad','common','none'])->default('none');
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
        Schema::dropIfExists('mr_orders');
    }
}
