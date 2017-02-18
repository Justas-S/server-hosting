<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameServer extends Model
{
    protected $fillable = [
        'game_id',
        'user_id',
        'server_id',
        'is_online',
        'version'
    ];  

    protected $table = 'game_servers';

    protected $hidden = [
        'pma_password',
        'pma_username',
        'ftp_username',
        'ftp_password',
        'version',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function game()
    {
        return $this->belongsTo(\App\Game::class);
    }

    public function server()
    {
        return $this->belongsTo(\App\Server::class);
    }

    public function databases()
    {
        return $this->hasMany(\App\Database::class);
    }

    public function ftp_users()
    {
        return $this->hasMany(\App\FtpUser::class);
    }

    public function server_package()
    {
        return $this->hasOne(\App\ServerPackage::class, 'id', 'server_package_id');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Calculates the price for this game server for a certain duration
     *
     * @param $duration_hours duration in hours
     * @return returns the price in cents
     */
    public function getPrice($duration_hours) 
    {
        return $this->hourly_cost * $duration_hours * 24 * 100;
    }

    public function getDatabaseAttribute()
    {
        return $this->databases()->whereNotNull('expired_on')->first();
    }

    public function getFtpUserAttribute()
    {
        return $this->ftp_users()->first();
    }
}
