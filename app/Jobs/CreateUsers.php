<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Server;

use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;

class CreateUsers implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $server;
    private $username;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Server $server, $username)
    {
        $this->server = $server;
        $this->username = $username;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->ssh = new SSH2($this->server->ip);
        $key = new RSA();
        $key->loadKey(file_get_contents(storage_path('keys/'.$this->server->id)));

        if($this->ssh->login('root', $key))
        {
            $this->ssh->exec("")
        }
    }
}
