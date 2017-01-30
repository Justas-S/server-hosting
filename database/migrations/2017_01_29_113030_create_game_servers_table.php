<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_servers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('ip');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('server_id')->unsigned();
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
            $table->float('hourly_cost');
            $table->boolean('is_online');

            $table->string('ftp_username')->nullable();
            $table->string('ftp_password')->nullable();

            $table->string('pma_username')->nullable();
            $table->string('pma_password')->nullable();

            $table->string('version')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('game_servers');
    }
}
