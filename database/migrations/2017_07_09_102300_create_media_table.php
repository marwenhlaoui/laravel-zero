<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('preview')->nullable();
            $table->enum('type', ['picture', 'video','audio','pdf','rar'])->default('picture');
            $table->string('size');
            $table->longText('data')->nullable();
            $table->string('title')->nullable()->default('');
            $table->integer('by')->unsigned()->nullable();
            $table->foreign('by')->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('media');
    }
}
