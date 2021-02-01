<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->bigInteger('send_id')->unsigned()->index(); 
            $table->bigInteger('get_id')->unsigned()->index(); 
            $table->bigInteger('mainlist_id')->unsigned()->index(); 
            $table->string('message');
            $table->timestamps();
            $table->foreign('send_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('get_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mainlist_id')->references('id')->on('mainlists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
