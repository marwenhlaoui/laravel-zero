<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->default('');
            $table->text('access');
            $table->timestamps();
        });

        Schema::create('service_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->unsigned();
            $table->foreign('user')->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('service')->unsigned();
            $table->foreign('service')->references('id')->on('service')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service');
        Schema::dropIfExists('service_user');
    }
}
