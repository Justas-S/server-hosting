<?php 



$configSuccess = editConfig();
if(!$configSuccess)
    echo "config failed\n";
else 
{
    $restartSuccess = restartSshService();
    if(!$restartSuccess)
        echo "restart failed\n";
    else 
        echo "success\n";
}

function restartSshService()
{
    $output = exec("service ssh restart");
    if($output == "")
        return true;

    $output = exec("/etc/init.d/sshd restart");
    return $output == "";
}

function editConfig()
{
    $output = [];
    exec('grep -w -n "^PasswordAuthentication \(yes\|no\)" /etc/ssh/sshd_config', $output);
    $lineNumber = getLineNumber($output);
    if($lineNumber > 0)
    {
        $line = trim(explode("\n", file_get_contents("/etc/ssh/sshd_config"))[$lineNumber - 1]);
        $spaceIdx = strpos($line, ' ');
        if($spaceIdx !== false) 
        {
            $value = substr($line, $spaceIdx + 1);
            if($value == "no")
                return true;

            if(!replaceLineWith('/etc/ssh/sshd_config', $lineNumber, 'PasswordAuthentication no'))
                return false;

            return true;
        }
    }
    $string = exec('echo "PasswordAuthentication no" >> /etc/ssh/sshd_config');
    return $string == "";
}

function getLineNumber($text) 
{
    foreach ($text as $line) 
    {
        $line = trim($line);
        $lineNumber = substr($line, 0, strpos($line, ':'));
        $spaceIdx = strpos($line, ' ');
        if($spaceIdx !== false) 
            return $lineNumber;
    }
    return 0;
}

function replaceLineWith($file, $lineNumber, $newLine)
{
    $src = fopen($file, 'r');
    $dest = fopen($file.'.tmp', 'w');
    $lineCount = 0;
    $replaced = false;
    while(($line = fgets($src)))
    {
        $lineCount++;
        if($lineCount == $lineNumber)
        {
            fwrite($dest, $newLine);
            $replaced = true;
        }
        else 
        {
            fwrite($dest, $line);
        }
    }
    fclose($src);
    fclose($dest);
    return rename($file.'.tmp', $file) && $replaced;
}

?>