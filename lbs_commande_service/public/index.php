<?php
/**
 * File:  index.php
 *
 */

require_once  __DIR__ . '/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
use \src\app\controller\CommandeController as CommandeController;


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
        'message'=>"$req:malformed uri"
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
    return function( $req, $resp , $methods ) {
    $resp= $resp
    ->withStatus( 404 )->withHeader('Content-type','application/json')
    ->write(json_encode(["type"=>"error",
        "message"=>'ressource non disponible : ']));
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
    \lbs\command\app\controller\CommandeController::class.":listCommands"
);
$app->get('/commande/{id}',
    \lbs\command\app\controller\CommandeController::class.":getCommande"
);
$app->get('/commande/{id}/items',
    \lbs\command\app\controller\ItemController::class.":getItems"
);
$app->post('/commande',
    \lbs\command\app\controller\CommandeController::class.":addCommande"
);
$app->put('/commande/{id}[/]',
    \lbs\command\app\controller\CommandeController::class.":replaceCommande"
);

$app->run();