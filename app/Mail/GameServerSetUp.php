<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GameServerSetUp extends Mailable
{
    use Queueable, SerializesModels;

    public $gameserver;

    public $database;

    public $db_user;

    public $ftp_user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(GameServer $gameserver, Database $db, DatabaseUser $db_user, FtpUser $ftp_user)
    {
        $this->gameserver = $gameserver;
        $this->database = $db;
        $this->db_user = $db_user;
        $this->ftp_user = $ftp_user;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.gameserver.setup');
    }
}
