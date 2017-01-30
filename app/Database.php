<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'game_server_id',
    ];

    protected $dates = [
        'expired_on',
    ];

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }

    public function dbusers()
    {
        return $this->hasMany(App\DatabaseUser::class);
    }

    public function gameserver()
    {
        return $this->belongsTo(App\GameServer::class);
    }

    public function getIsExpiredAttribute()
    {
        if ($this->expired_on) 
        {
            // Less than or equals
            return $this->expired_on->lte(\Carbon\Carbon::now());
        }
        else
        {
            return false;
        }
    }
}
