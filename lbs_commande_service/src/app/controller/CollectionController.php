<?php

namespace lbs\fab\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
use  lbs\command\app\models\Command as Command;

use Illuminate\Support\Str;


class CollectionController{
    private $c; //le conteneur de dépendance de l'application
    
    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }
    function listCollection (Request $rq, Response $rs, array $args):Response{
        echo "test";

        $collection = Command::select(['id','nom', 'created_at', 'livraison', 'status'])->get();

        $rs = $rs->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
        $data =[
            'type'=>'collection',
            'count'=>count($collection),
            'commands'=>$collection->toArray()


        ];
        $rs->getBody()->write(json_encode($data));

        return  $rs;
    }




}