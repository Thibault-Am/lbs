<?php

namespace lbs\fab\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
use  lbs\fab\app\models\Command as Command;

use Illuminate\Support\Str;



class CollectionController{
    private $c; //le conteneur de dépendance de l'application
    
    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }
    function listCollection (Request $rq, Response $rs, array $args):Response{
       
        $s = $rq->getQueryParam('s',null);
        $page = $rq->getQueryParam('page',1);
        $size = $rq->getQueryParam('size',10);
        if ($s!=null){
            $collection = Command::select(['id','nom', 'created_at', 'livraison', 'status'])->where('status',$s )->orderBy('livraison')->get();
        }else{
            $collection = Command::select(['id','nom', 'created_at', 'livraison', 'status'])->orderBy('livraison')->get();
        }



        $rs = $rs->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
        $toutCommands=[];
        $page_after=$page+1;
        $page_before=$page-1;
        $last_dec=count($collection)/$size;
        $last=intval($last_dec);
        if ($last<$last_dec){
            $last=$last+1;
        }
        if($page>=$last){
            $page=$last;
            $page_before=$page-1;
            $page_after=$page;
        }
        if($page<=1){
            $page=1;
            $page_before=1;
            $page_after=2;
        }
        $data =[
            'type'=>'collection',
            'count'=>count($collection),






            //////TD6 4. pagination avancée///////////////////////////






            'links'=>['next'=>[
                'href'=>"/commandes?page=$page_after&size=$size"
            ],
            'prev'=>[
                'href'=>"/commandes?page=$page_before&size=$size"
            ],
            'first'=>[
                'href'=>"/commandes?page=1&size=$size"
            ],
            'last'=>[
                'href'=>"/commandes?page=$last&size=$size"
            ],
        ]
        ];
        for ($i=0; $i <count($collection) ; $i++) { 

            $links = ['self'=>[
                'href'=>'/commande/'.$collection[$i]->id
            ]];
            $collection->makeVisible('created_at');
       
            array_push($toutCommands,['command'=>$collection[$i],
            'links'=>$links]);
           
            
        }
        if($page!=1){
            $page=($page*$size)-($size-1);
            $data+=['commands'=>array_slice($toutCommands,$page,$size)];
        }else if($page<=1){
            $data+=['commands'=>array_slice($toutCommands,$page,$size)];
        }
       
        $rs->getBody()->write(json_encode($data));

        return  $rs;
    }


}