<?php

return[
    'settings'=>[
        'displayErrorDetails'=>true,
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