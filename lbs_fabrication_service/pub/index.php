<?php
/**
 * File:  index.php
 *
 */

require_once  __DIR__ . '/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
use lbs\fab\app\controller\CollectionController as CollectionController;
use lbs\fab\app\models\Command as Command;
use lbs\fab\app\middlewares\Token as Token;

$settings= require_once __DIR__.'/../src/app/conf/settings.php';
$errors = require_once __DIR__ . '/../src/app/errors/errors.php';
//$dependencies = require_once __DIR__.'/../src/app/conf/dependencies.php';
/*$configuration = [
    
    'settings' => [
    'dbfile'=>__DIR__.'/../src/conf/db.conf.ini',
    'displayErrorDetails' => true]
    ];*/
$conf = parse_ini_file('../src/app/conf/commande.db.conf.ini') ;
$db = new \Illuminate\Database\Capsule\Manager();

$db->addConnection( $conf ); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();  

$app_conf=array_merge($settings);
$c = new \Slim\Container($app_conf);
$c[ 'notFoundHandler' ]= function( $c ) {
    return function( $req, $resp ) {
        $resp= $resp->withStatus( 400 )->withHeader('Content-type','application/json') ;
        $resp->getBody()->write(json_encode(['type'=>'error',
        'error'=>400,
        'message'=>":malformed uri"
        ]) ) ;
        return $resp ;
    } ;
};
$c['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
        return $response->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode([
                'type'=>'error',
                'message'=>'Method must be one of: ' . implode(', ', $methods)]));
    };
};
$c[ 'errorHandler' ]= function( $c ) {
    return function( $req, $resp , \Exception $e ) {
    $resp= $resp
    ->withStatus( 500 )->withHeader('Content-type','application/json') ;
    $resp->getBody()->write(json_encode(["type"=>"error",
        "message"=>'erreur  : '. $e->getMessage()]));
    return $resp ;
    };
};
$c[ 'phpErrorHandler' ]= function( $c ) {
    
    return function( $req, $resp , $e ) {
        $resp= $resp->withStatus( 500 )->withHeader('Content-type','application/json'); 
        $resp->getBody()
        ->write(json_encode(['type'=>'error',
            'error'=>500,
            "message"=>"internal server error: {$e->getMessage()}",
            "trace"=>$e->getTraceAsString(),
            "file"=>$e->getFile()." line: ".$e->getLine()
            ]));
        return $resp ;
    };
};

$app = new \Slim\App($c);

$app->get('/commandes',
    \lbs\fab\app\controller\CollectionController::class.":listCollection"
);


$app->run();