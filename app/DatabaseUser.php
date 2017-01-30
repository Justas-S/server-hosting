<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatabaseUser extends Model
{
    protected $fillable = [
        'user_id',
        'database_id',
        'username',
    ];

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }

    public function database()
    {
        return $this->belongsTo(App\Database::class);
    }
}
