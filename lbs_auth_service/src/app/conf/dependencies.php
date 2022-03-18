<?php

return [
    'dbhost'=>function (\Slim\Container $c){
        $config = parse_ini_file($c->settings['dbfile']);
        return $config['host'];
    },

    /*'logger' => function(\Slim\Container $c){
        $log = new \MonoLog\Logger($c->settings['log.name']);
        $log->pushHandler(new \Monolog\Handler\StreamHandler($c->settings['debug.log'], $c->settings['log.level']));
        return $log;
    }*/
];