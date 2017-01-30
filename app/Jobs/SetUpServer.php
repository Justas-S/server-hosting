<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Server;
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use Symfony\Component\Process\Process;
use File;
use App\Events\ServerSetUpFailed;
use App\Installers\Ubuntu64Installer;

define('NET_SSH2_LOGGING', 2);

// TODO create group linux group

class SetUpServer implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $server;
    private $ssh;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $server = $this->server;
        $installer = null;   
        $this->ssh = new SSH2($server->ip);
        try {
            $success = $this->ssh->login('root', $server->password);   
            if(!$success)
                $this->fail("Login failed");
            // TODO check for success
            $this->ssh->enablePTY();

            $distro = $this->getDistro();
            $os = $this->getOs();
            if($os == "GNU/Linux") {
                if($distro == "Ubuntu") {
                    $installer = new Ubuntu64Installer($this->ssh, $server->ip, $server->password, $this->getKey($server));
                }
            }
        } catch(\ErrorException $e) {
            $this->fail("connection refused(".$e->getMessage().")", $e->getTraceAsString(), $server, $this->ssh->getLog(), $this->ssh->getStdError());
            echo($e);
        } finally {
            $this->ssh->disconnect();
        }
        if($installer) {
            $success = $installer->install();
            if($success)
                dd("Amazing");
            else {
                $this->fail($installer->getLog(), $installer->getErrorLog());
            }
        } else {
            $this->fail("Unsupported version ".$os." ".$distro);
        }
    }

    private function fail($msg)
    {
        event(new ServerSetUpFailed($this->server, $msg));
        $this->ssh->disconnect();
        dd(func_get_args());
    }

    private function getDistro()
    {
        $output = trim($this->ssh->exec("cat /etc/*-release | grep ^NAME="));
        return ($index = strpos($output, "=")) !== false ? trim(substr($output, $index+2, -1)) : $output;
    }

    private function getOs() 
    {
        return trim($this->ssh->exec("uname -o"));
    }

    private function getKey($server) 
    {
        $key = new RSA();
        $path = storage_path('keys/'.$server->id);
        if(!file_exists($path)) 
        {
            $this->generateKey($path);
        }
        $key->loadKey(file_get_contents($path));
        return $key;
    }

    private function generateKey($path) 
    {
        File::makeDirectory(storage_path('keys'));
        $process = new Process("ssh-keygen -f ".$path." -t rsa -N ''");
        $process->run();
        if (!$process->isSuccessful()) {
            return false;
        }
        return true;
    }
}
