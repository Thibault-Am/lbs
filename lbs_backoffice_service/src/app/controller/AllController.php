<?php

namespace lbs\backoffice\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Str;

use lbs\backoffice\app\utils\Writer;


class AllController{
    private $c; //le conteneur de dépendance de l'application
    
    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }
    function autGateway (Request $rq, Response $rs, array $args):Response{
       
        $client = new Client([
            'base_uri' => 'http://api.auth.local:80',
            'timeout' => 5.0
        ]);
        $response = $client->request('GET', '/auth', [
        'headers'=> ['Authorization' => $rq->getHeader('Authorization')]
        ]
        );
        return $rs->withStatus($response->getStatusCode())
        ->withHeader('Content-Type', $response->getHeader('Content-Type'))
        ->withBody($response->getBody());

    }
    function commandeGateway (Request $rq, Response $rs, array $args):Response{

        $client = new Client([
            'base_uri' => 'http://api.fabrication.local:80',
            'timeout' => 5.0
        ]);

       if($rq->getHeader('Authorization')!=null){
            $client = new Client([
                'base_uri' => 'http://api.auth.local:80',
                'timeout' => 5.0
            ]);
           try{ 
                $response = $client->request('GET', '/check', [
                    'headers'=> ['Authorization' => $rq->getHeader('Authorization')]
                    ]
                );
                
                if($response->getStatusCode()==200){
                    $client = new Client([
                        'base_uri' => 'http://api.fabrication.local:80',
                        'timeout' => 5.0
                    ]);
                    $query= $rq->getQueryParams();
                    $response = $client->request('GET', '/commandes', [
                        'query'=>$query, 'timeout'=>30
                        ]
                    );
                }
             
                return $rs->withStatus($response->getStatusCode())
                ->withHeader('Content-Type', $response->getHeader('Content-Type'))
                ->withBody($response->getBody());
            
            }catch(\Exception $e){
                
                $rs = $rs->withStatus(401)->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
                $data =[
                    'type'=>'error',
                    'error'=>401,
                    'message'=>$e->getMessage()
                
                
                ];
                $rs->getBody()->write(json_encode($data));
                
                return $rs;
            }
            
       }else{
            $rs = $rs->withStatus(401)->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
            $data =[
                'type'=>'error',
                'error'=>401,
                'message'=>'pas d\'access token'
            
            
            ];
            $rs->getBody()->write(json_encode($data));
            
            return $rs;
       }

        
    }

}