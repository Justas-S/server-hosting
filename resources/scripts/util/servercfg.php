<?php 


function toJson($content) {
    $lines = explode("\n", $content);
    $output = [];
    foreach ($lines as $line) {
        $index = strpos($line, " ");
        // Everything must be K V pairs
        if (!$index) continue;

        $key = trim(substr($line, 0, $index));
        $value = trim(substr($line, $index));
        
        if ($key == 'filterscripts') {
            $filterscripts = explode(" ", $value);
            foreach ($filterscripts as $filterscript) {
                $output['filterscripts'][] = $filterscript;
            }
        } else if ($key == 'plugins') {
            $plugins = explode(" ", $value);
            foreach ($plugins as $plugin) {
                $output['plugins'][] = $plugin;
            }
        } else {
            $output[$key] = $value;
        }
    }
    return json_encode($output);
}

function toString($json) {
    $data = json_decode($json);
    $file_content = "";
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $file_content .= $key." ".implode(" ", $value);
        } else {
            $file_content .= $key." ".$value;   
        }
        $file_content .= PHP_EOL;
    }
    return $file_content;
}


function getDefaultJson() {
    return json_encode([
        'echo'  => 'Executing Server Config...',
        'lanmode'           => 0,
        'maxplayers'        => 50,
        'announce'          => 0,
        'query'             => 1,
        'port'              => 7777,
        'hostname'          => 'SA-MP 0.3 Server',
        'gamemode0'         => 'bare',
        'weburl'            => 'www.sa-mp.com',
        'rcon_password'     => 'mustbechangedforever',
        'filterscripts'     => [],
        'plugins'           => [],
        'password'          => '',
        'mapname'           => 'San Andreas',
        'language'          => 'English',
        'bind'              => '',
        'rcon'              => 1,
        'maxnpc'            => 0,
        'onfoot_rate'       => 40,
        'incar_rate'        => 40,
        'weapon_rate'       => 40,
        'stream_distance'   => 300.0,
        'stream_rate'       => 1000,
        'timestamp'         => 1,
        'logqueries'        => 0,
        'logtimeformat'     => '[%H:%M:%S]',
        'output'            => 0,
        'gamemodetext'      => 'Unknown',
        'chatlogging'       => 1,
        'messageholelimit'  => 3000,
        'messageslimit'     => 500,
        'lagcompmode'       => 1,
        'ackslimit'         => 3000,
        'playertimeout'     => 10000,
        'minconnectiontime' => 0,
        'conseedtime'       => 300000,
        'sleep'             => 5,
        'conncookies'       => 1,
        'cookielogign'      => 1,
        'db_logging'        => 1,
        'db_log_queries'    => 1,
    ]); 
}