<?php

namespace app\Installers;

interface IServerInstaller 
{

    public function getLog();

    public function getErrorLog();

    public function install();
}