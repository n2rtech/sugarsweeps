<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedeemCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('platform_id');
            $table->string('username')->nullable();
            $table->string('amount')->nullable();
            $table->unsignedBigInteger('payment_method_id');
            $table->string('cashtag')->nullable();
            $table->string('bitcoin_address')->nullable();
            $table->enum('redeem_full', ['yes', 'no'])->default('no');
            $table->enum('status', ['0', '1', '2', '3'])->default('0');
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->foreign('cashier_id')->references('id')->on('cashiers')->onDelete('cascade');
            $table->dateTime('action_taken_at')->nullable();
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
        Schema::dropIfExists('redeem_requests');
    }
}
