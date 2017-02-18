<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $table = 'plugins';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'game_id',
        'version',
        'url',
    ];

    public function game()
    {
        return $this->belongsTo(App\Game::class);
    }
}
