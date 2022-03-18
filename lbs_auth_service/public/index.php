<?php
/**
 * File:  index.php
 *
 */

require_once  __DIR__ . '/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
use lbs\auth\app\controller\LBSAuthController as LBSAuthController;

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
    return function( $req, $resp, \Exception $e  ) {
        $resp= $resp->withStatus( 400 )->withHeader('Content-type','application/json') ;
        $resp->getBody()->write(json_encode(['type'=>'error',
        'error'=>400,
        'message'=>":malformed uri". $e->getMessage()
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
function checkToken ( Request $rq, Response $rs, callable $next ) {
            
         
    // récupérer l'identifiant de cmmde dans la route et le token
        $id = $rq->getAttribute('route')->getArgument( 'id');
        $token = $rq->getQueryParam('token', null);

        
        // vérifier que le token correspond à la commande
        try {
            Command::where('id', '=', $id)
            ->where('token', '=',$token)
            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // générer une erreur
            $rs->getBody()->write('erreur');
            return $rs ;
        };
        return $next($rq, $rs);
}
$app = new \Slim\App($c);

$app->get('/auth',
    \lbs\auth\app\controller\LBSAuthController::class.":authenticate"
);
$app->get('/check',
    \lbs\auth\app\controller\LBSAuthController::class.":checkValiditeToken"
);
// $app->put('/commande/{id}[/]',
//     \lbs\command\app\controller\CommandeController::class.":replaceCommande"
// );
// $app->get('/commande/{id}/items[/]',
//      \lbs\command\app\controller\CommandeController::class.":getItems")
//      ->add(\lbs\command\app\middlewares\Token::class .':checkToken')
//      ->setName('commandeItems');

// $app->get('/commande/{id}',
// \lbs\command\app\controller\CommandeController::class.":getCommand")
// ->add(\lbs\command\app\middlewares\Token::class .':checkToken')
// ->setName('commande');

$app->run();