<?php 
namespace App\Services;

use App\Server;
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use Log;

/**
 * Fulfills all the needs for Server SSH stuff
 */ 
class ServerSshManager 
{
    /**
     * Executes a script on the specified remote server
     *
     * @param $server remote server to run the script on
     * @param $script script name, no path
     * @param $params array parameters to pass to the script
     *
     * @return true on successful script execution, false otherwise
     */
    public function execute(Server $server, $script, array $params)
    {   
        $ssh = $this->getSsh($server);
        if (!isValidScript($ssh, $script)) {
            $this->transferScripts($server);
        }

        $output = $ssh->exec('php -f /root/scripts/$script '.implode(' ', $params));
        $ssh->disconnect();
        if($output == '1')
            return true;

        Log::error($output);
        return false;
    }

    /**
     * Checks weather a script exists
     * 
     * @param $ssh  ssh connection
     * @param $script script file name
     * 
     * @return true if script exists in the script folder, false otherwise
     */ 
    private function isValidScript($ssh, $script)
    {
        return $ssh->exec("if test -f $script; then echo 1; else echo 0; fi") == '1';
    }

    /**
     * Transfers all the local scripts to remote server
     * 
     * @param $server server to use
     *
     * @return Transfered file count or false if could not connect
     */
    public function transferScripts(Server $server)
    {
        $sftp = $this->getSftp($server);
        if ($sftp) {
            $transfered_file_count = $this->transferDir($sftp, resource_path('scripts'), '/root/scripts');
            $sftp->disconnect();
            return $transfered_file_count;
        }
        return false;
    }

    /**
     * Transfers all the contents from local folder to remote over the specified sftp handle
     *
     * @param $sftp SFTP connection to use
     * @param $local_path path on the local machine
     * @param $remote_path path on the remote machine
     * 
     * @return Number of files transfered 
     */
    private function transferDir($sftp, $local_path, $remote_path) {
        $sftp->mkdir($remote_path);
        // List the local scripts
        $scripts = scandir($local_path);
        $count = 0;
        foreach ($scripts as $script) {   
            // If it move around bad things would happen
            if ($script == '.' || $script == '..') {
                continue;
            }

            $script_path = $local_path."/".$script;
            if (!is_file($script_path))
                $count += $this->transferDir($sftp, $script_path, $remote_path."/".$script);
            else {
                try {
                    $sftp->put($remote_path."/".$script, file_get_contents($script_path));
                    $count++;
                } catch(\Exception $e) { }
            }
        }
        return $count;
    }

    /**
     * Creates a SSH connection to the target server
     * Priority authentication is SSH keys
     * 
     * @param $server to create a ssh connection to
     *
     * @return phpseclib\Net\SSH2 connection or null if the connecting or authenticating failed
     */ 
    private function getSsh(Server $server) {
        $ssh = new SSH2($server->ip);
        $key = $this->getKey($server);
        if (($key != null && $ssh->login('root', $key)) || $ssh->login('root', $server->password))
            return $ssh;
        else {
            $ssh->disconnect();
            return null;
        }
    }

    /**
     * Creates an SFTP connection to the remote server
     * Priority auth type is SSH key, if that fails defaults to password
     * 
     * @param $server server to create an SFTP connetion with
     *
     * @return phpseclib\Net\SFTP instance or null if connection or auth failed
     */ 
    private function getSftp(Server $server) {
        $sftp = new SFTP($server->ip);
        $key = $this->getKey($server);
        if (($key != null && $sftp->login('root', $key)) || $sftp->login('root', $server->password))
            return $sftp;
        else {
            $sftp->disconnect();
            return null;
        }
    }

    /**
     * Returns the saved SSH key for a server
     *
     * @param $server
     *
     * @return phpseclib\Crypt\RSA instance of null if key does not exist
     */
    private function getKey(Server $server) {
        $rsa = new RSA();
        $key = file_get_contents(storage_path('keys/'.$server->id));
        if ($key) {
            $rsa->loadKey($key);
            return $sa;
        } 
        return null;
    }
}

