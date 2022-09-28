<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['notification','request-account', 'account-approved','account-created', 'account-rejected','credit-requested', 'credit-added', 'credit-rejected', 'transfer-request', 'transfer-done', 'transfer-rejected', 'redeem-request', 'redeem-done', 'redeem-rejected'])->nullable();
            $table->enum('sender', ['player', 'admin', 'cashier'])->default('admin');
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->unsignedBigInteger('gaming_account_id')->nullable();
            $table->foreign('gaming_account_id')->references('id')->on('gaming_accounts')->onDelete('cascade');
            $table->unsignedBigInteger('credit_request_id')->nullable();
            $table->foreign('credit_request_id')->references('id')->on('credit_requests')->onDelete('cascade');
            $table->unsignedBigInteger('redeem_request_id')->nullable();
            $table->foreign('redeem_request_id')->references('id')->on('redeem_requests')->onDelete('cascade');
            $table->enum('seen', ['yes', 'no'])->default('no');
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
