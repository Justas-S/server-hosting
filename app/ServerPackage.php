<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerPackage extends Model
{
    protected $table = 'server_packages';

    protected $fillable = [
        'game_id',
        'name',
        'version',
        'url',
    ];

    public function game()
    {
        return $this->belongsTo(\App\Game::class);
    }
}   
