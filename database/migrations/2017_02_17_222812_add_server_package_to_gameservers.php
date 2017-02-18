<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServerPackageToGameservers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_servers', function ($table) {
            $table->integer('server_package_id')->unsigned()->nullable();
            $table->foreign('server_package_id')->references('id')->on('server_packages')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_servers', function ($table) {
            $table->dropColumn('game_servers');
        });
    }
}
