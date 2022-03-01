<?php
namespace lbs\command\errors;

use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App();
$c = $app->getContainer() ;


/*return [
    'notFoundHandler' => function(\Slim\Container $c){
        return function (Request $req, Response $res){
            $res =$res->withStatus(400)->withHeader('Content-type','application/json');
            $res->write(json_encode([
                'type'=>'error',
                'code'=>404,
                'message'=>'ressources non disponible : '.$req->getUri(),
            ]));
            return $res;
        };
    },
    'notAllowedHandler' => function(\Slim\Container $c){
        return function (Request $req, Response $res, array $methods){
            $method =$req->getMethod();
            $url=$req->getUri();

            $res =$res->withStatus(400)->withHeader('Content-type','application/json');
            $res->write(json_encode([
                'type'=>'error',
                'code'=>405,
                'message'=>'méthode '.$method.' qui n\'est pas prévue sur la route demandée : '.$req->getUri(),
            ]));
            return $res;
        };
    },
    'errorHandler' => function(\Slim\Container $c){
        return function (Request $req, Response $res, array $methods){
            $method =$req->getMethod();
            $url=$req->getUri();

            $res =$res->withStatus(400)->withHeader('Content-type','application/json');
            $res->write(json_encode([
                'type'=>'error',
                'code'=>400,
                'message'=>'la requête est mal formée: '.$req->getUri(),
            ]));
            return $res;
        };
    },
    'phpErrorHandler' => function(\Slim\Container $c){
        return function (Request $req, Response $res, array $methods){
            $method =$req->getMethod();
            $url=$req->getUri();

            $res =$res->withStatus(500)->withHeader('Content-type','application/json');
            $res->write(json_encode([
                'type'=>'error',
                'code'=>500,
                'message'=>'erreur d\'exécution au sein du serveur: '.$method.$req->getUri(),
            ]));
            return $res;
        };
    },
];*/