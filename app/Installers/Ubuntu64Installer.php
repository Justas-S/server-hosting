<?php 

namespace App\Installers;

use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use App\Installers\Exceptions\InstallerException;

class Ubuntu64Installer extends ServerInstaller 
{
    public function __construct(SSH2 $ssh, $host, $password, RSA $key)
    {
        parent::__construct($ssh, $host, $password, $key);
    }

    public function isPhpInstalled()
    {
        $response = $this->ssh->exec("php --version");
        return strpos($response, "command not found") === false;
    }

    public function installPhp()
    {
        return $this->ssh->exec("apt-get --assume-yes install php7.0");
    }

    public function setSshKey()
    {
        $key = $this->key->getPublicKey(RSA::PUBLIC_FORMAT_OPENSSH);
        // Success is considered that that appending to 'authorized_keys' file produced no errors
        // And that file now contains the key
        $output = $this->ssh->exec('echo "'.$key.'" >> ~/.ssh/authorized_keys');
        dd($this->ssh, $output, 'echo "'.$key.'" >> ~/.ssh/authorized_keys');
        if($output != "" || strpos($this->ssh->exec('cat ~/.ssh/authorized_keys'), $key) === false)
            throw new InstallerException("Can not set ssh key", $output);
    }

    public function testSshKey()
    {
        $ssh = new SSH2($this->host);
        $success = false;
        try {
            $ssh->login('root', $this->key);   
            $success = $ssh->isAuthenticated();
            $ssh->disconnect();
        } catch(\Exception $e) { }
        return $success;
    }

    public function disablePasswordLogin()
    {
        $output = $this->ssh->exec("php -f scripts/disable_password_login.php");
        //dd($output);
        if($output == 'success')
            return $output;
        else
            throw new InstallerException("Can not disable password login", $output); 
    }

    /**
        Must return mysql password on success
        Throws InstallerException
    */
    public function installMySql()
    {
        $this->ssh->exec("debconf-set-selections <<< 'mysql-server mysql-server/root_password password'");
        $this->ssh->exec("debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password'");
        $output = $this->ssh->exec("apt-get -y install mysql-server");
        if(strpos($this->ssh->exec("mysql --version"), "error") !== false)
            throw new InstallerException("Can not install mysql", $output);
    }

    public function disableRemoteMySqlRoot()
    {
        $output = [];
        $output[] = $this->ssh->exec("mysql -u root");
        $output[] = $this->ssh->exec("DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');");
        $output[] = $this->ssh->exec("FLUSH PRIVILEGES;");
        $output[] = $this->ssh->exec("exit");
        foreach($output as $o)
            if(strpos($o, "error") !== false)
                throw new InstallerException("Can not restrict root remote access", $output);
        return $output;
    }

    public function installPhpMyAdmin()
    {
        $this->ssh->exec("DEBIAN_FRONTEND=noninteractive apt-get -y install phpmyadmin");
    }

    public function isWebServerInstalled()
    {
        return strpos($this->ssh->execute("service nginx"), "unrecognized") === false;
    }

    public function installWebServer()
    {
        $output = $this->ssh->exec("apt-get -y install nginx");
        if(!$this->isWebServerInstalled())
            throw new InstallerException("Can not install nginx web server", $output);
        $this->ssh->exec("cp scripts/pma /etc/nginx/sites-available");
        $this->ssh->exec("ln -s /etc/nginx/sites-available/pma /etc/nginx/sites-enabled/pma");
        $this->ssh->exec("ln -s /usr/share/phpmyadmin /var/www/nginx/phpmyadmin");
        $output = $this->ssh->exec("service nginx restart");
        return $output;
    }

    public function installMisc()
    {
        $this->ssh->exec("apt-get -y install debconf-utils");
    }

}