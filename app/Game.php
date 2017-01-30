<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'identifier',
    ];

    public function service() 
    {
        return $this->belongsTo(\App\Service::class);
    }

    public function getRouteKeyName()
    {
        return 'identifier';
    }
}
