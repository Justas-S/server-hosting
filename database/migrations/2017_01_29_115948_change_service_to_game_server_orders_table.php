<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeServiceToGameServerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function ($table) {
            $table->integer('game_server_id')->unsigned();
            $table->foreign('game_server_id')->references('id')->on('game_servers')->onDelete('cascade');
        });
    }   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function ($table) {
            $table->dropForeign('orders_game_server_id_foreign');
            $table->dropColumn('game_server_id');
        });
    }
}
