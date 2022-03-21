<?php

return[
    'settings'=>[
        'displayErrorDetails'=>true,
        'secret'=>'68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=',
        //'dbfile'=>__DIR__.'/commande.db.conf.ini',
        /*'debug.log'=>__DIR__.'/../log/debug.log',
        'log.level'=>\Monolog\Logger::DEBUG,
        'log.name'=>'slim.log'*/
    ]/*,
    'dbhost'=>function (\Slim\Container $c){
        $config = parse_ini_file($c->settings['dbfile']);
        return $config['host'];
    }*/
];