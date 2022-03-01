<?php

namespace lbs\command\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
use  lbs\command\app\models\Items as Items;

class ItemController {

    function getItems (Request $rq, Response $rs, array $args):Response{
      
        $items = Items::select(['id','libelle', 'tarif', 'quantite'])->where('command_id','=', $args['id'])->get();
        $rs = $rs->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
        $data =[
            'type'=>'collection',
            'count'=>count($items),
            'items'=>$items->toArray()
        ];
        $rs->getBody()->write(json_encode($data));
        return  $rs;
    }
}