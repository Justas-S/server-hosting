<?php 

namespace app\Installers\Exceptions;

class InstallerException extends \Exception 
{
    protected $processOutput;

    public function __construct($message, $processOutput)
    {
        parent::__construct($message);
        $this->processOutput = $processOutput;
    }

    public function getProcessOutput()
    {
        return $this->processOutput;
    }
}