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

    public function server_packages()
    {
        return $this->hasMany(\App\ServerPackage::class);
    }

    public function plugins()
    {
        return $this->hasMany(App\Plugin::class);
    }

    public function getDefaultServerPackageAttribute()
    {
        return $this->plugins()->orderBy('created_at', 'DESC')->first();
    }    

    public function getRouteKeyName()
    {
        return 'identifier';
    }
}
