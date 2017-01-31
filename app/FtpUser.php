<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FtpUser extends Model
{
    protected $fillable = [
        'user_id',
        'game_server_id',
        'username',
    ];  

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }

    public function gameserver()
    {
        return $this->belongsTo(App\GameServer::class);
    }
}
