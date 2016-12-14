<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'ip',
        'server_id',
        'price',
        'game_id',
    ];

    public function game() 
    {
        return $this->hasOne(\App\Game::class);
    }

    public function scopeByGame($query)
    {
        return $query->groupBy('game_id');
    }


    public function getRouteKeyName()
    {
        return 'id';
    }
    
}
