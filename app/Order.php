<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'service_id',
        'duration',
        'email',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function service()
    {
        return $this->belongsTo(\App\Service::class);
    }
}
