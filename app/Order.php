<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'game_server_id',
        'duration',
        'email',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function gameserver()
    {
        return $this->belongsTo(\App\GameServer::class, 'game_server_id', 'id');
    }
}
