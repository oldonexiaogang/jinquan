<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('avatar')->nullable();
            $table->enum('sex',['Mr','Ms'])->default('Mr')->comment('性别');
            $table->enum('girl_level',['1','2','3','4','5'])->default('5')
                ->comment('女神级别：素人、班花、校花、女神、明星');
            $table->string('info')->nullable()->comment('详细介绍');
            $table->string('tel')->comment('注册电话');
            $table->string('huobi_addr')->nullable()->comment('火币地址');
            $table->string('local_addr')->nullable()->comment('本地钱包地址');
            $table->decimal('total_jinquan',20,8)->default(0);
            $table->decimal('frozen_jinquan',20,8)->default(0)->comment('冻结中金权');
            $table->string('idcard')->nullable()->comment('编号');
            $table->decimal('commision',10,2)->nullable()->comment('佣金比例')->default('70');
            $table->string('weixin_openid')->unique()->nullable();
            $table->string('weixin_unionid')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
