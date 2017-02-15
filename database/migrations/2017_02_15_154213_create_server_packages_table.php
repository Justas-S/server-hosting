<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_packages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->string('name');
            $table->string('version');
            $table->string('url');
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
        Schema::dropIfExists('server_packages');
    }
}
