<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'servers';


    protected $fillable = [
        'name',
        'provider',
        'ip',
        'ssh_key',
        'password',
        'is_online',
        'is_installed',
    ];

    
}
