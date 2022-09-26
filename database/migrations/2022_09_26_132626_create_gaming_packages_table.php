<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamingPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaming_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package');
            $table->string('gemini')->nullable();
            $table->string('orionstars')->nullable();
            $table->string('riversweeps')->nullable();
            $table->string('vpower')->nullable();
            $table->string('ultramonster')->nullable();
            $table->string('firekirin')->nullable();
            $table->string('bluedragons')->nullable();
            $table->string('pandamaster')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('gaming_packages');
    }
}
