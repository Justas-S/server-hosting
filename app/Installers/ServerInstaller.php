<?php 

namespace app\Installers;

use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use phpseclib\Net\SFTP;
use App\Installers\IServerInstaller;

abstract class ServerInstaller implements IServerInstaller
{
    protected $ssh;

    protected $key;

    protected $log = [];

    protected $errorLog = [];

    protected $host;

    public function __construct(SSH2 $ssh, $host, RSA $key)
    {
        $this->ssh = $ssh;
        $this->host = $host;
        $this->key = $key;
    }

    public function getLog()
    {
        return $log;
    }

    public function getErrorLog()
    {
        return $this->errorLog;
    }

    public function install()
    {
        $this->log("Starting installation ". $this->osType." ".$this->distro);
        if(!$this->isPhpInstalled())
        {
            $this->log("PHP not installed, attempting to resolve from package manager...");
            $output = $this->installPhp();
            if(!$this->isPhpInstalled())
            {
                $this->log("PHP installation failed");
                $this->error($output);
                return false;
            }
            else 
                $this->log("PHP installation successful");
        }



        try {
            $this->log("Installing misc files...");
            $this->installMisc();
            $this->log("Finished");

            $this->log("Downloading scripts...");
            $count = $this->transferScripts();
            $this->log($count. " scripts downloaded");

            $this->log("Setting ssh key..");
            $this->setSshKey();
            $this->testSshKey();
            $this->log("Ssh key setup succcessful");

            $this->log("Disabling ssh password authentication...");
            $this->disablePasswordLogin();
            $this->log("Ssh password login disabled");

            $this->log("Installing mysql....");
            $this->installMySql();
            $this->log("MySql installation successful");

            $this->log("Disabling remote mysql root login...");
            $this->disableRemoteMySqlRoot();
            $this->log("MySql remote root login disabled");

            $this->log("Installing phpmyadmin...");
            $this->installPhpMyAdmin();
            $this->log("phpmyadmin installed");
        } catch(InstallerException $e) {
            $this->log("Failed");
            $this->error($e->getMessage());
            $this->error($e->getProcessOutput());
            return false;
        }
        return true;
    }

    private function transferScripts()
    {   
        $sftp = new SFTP($this->host);
        if (!$sftp->login('root', $this->key)) 
        {
            throw new InstallerException("Login failed", $sftp->getLastSFTPError());
        }
        else 
        {
            $scripts = scandir(base_path('scripts'));
            foreach($scripts as $script)
            {
                try {
                    $sftp->put('scripts/'.$script, file_get_contents($script));
                } catch(\Exception $e) {} 
            }
            $sftp->disconnect();
            return sizeof($scripts);
        }
        return false;
    }

    private function log($text)
    {
        $log[] = $text."\n";
    }

    private function error($text)
    {
        $errorLog[] = $text."\n";
    }


    /**
        Dependency stuff
    */
    abstract public function isPhpInstalled();

    abstract public function installPhp();

    abstract public function setSshKey();

    abstract public function testSshKey();

    abstract public function disablePasswordLogin();

    /**
        Must return mysql password on success
        Throws InstallerException
    */
    abstract public function installMySql();

    abstract public function disableRemoteMySqlRoot();

    abstract public function installPhpMyAdmin();

    abstract public function isWebServerInstalled();

    abstract public function installWebServer();

    abstract public function installMisc();


}