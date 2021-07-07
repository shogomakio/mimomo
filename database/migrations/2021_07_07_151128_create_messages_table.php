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
            $table->bigIncrements('id');
            $table->bigInteger('fk_room_id')->unsigned()->nullable()->index();
            $table->bigInteger('fk_user_id')->unsigned()->nullable()->index();
            $table->text('message')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('fk_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fk_room_id')->references('id')->on('rooms')->onDelete('cascade');

            $table->index(['fk_user_id', 'fk_room_id']);
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
