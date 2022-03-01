<?php

namespace lbs\command\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
//docker-compose start démarrer le serv url http://api.commande.local:19080/
use  lbs\command\app\models\Command as Command;

use Illuminate\Support\Str;

class CommandeController {
    
    // public $commandes=[
    //     ["id"=> "AuTR4-65ZTY",
    //     "mail_client"=> "jan.neymar@yaboo.fr",
    //     "date_commande"=> "2022-01-05 12:00:23",
    //     "montant"=> 25.95],
    //     ["id"=> "azfafa-65ZTY",
    //     "mail_client"=> "jan.neymar@yaboo.fr",
    //     "date_commande"=> "2022-01-05 12:00:23",
    //     "montant"=> 25.95],
    //     ["id"=> "AoenivaZTY",
    //     "mail_client"=> "jan.neymar@yaboo.fr",
    //     "date_commande"=> "2022-01-05 12:00:23",
    //     "montant"=> 25.95],
    // ];
    /*public function listCommands(Request $rsq, Response $rsp, $args){
        echo $commandes;
        return "coucou";
    }*/
    private $c; //le conteneur de dépendance de l'application
    
    public function __construct(\Slim\Container $c){
        $this->c=$c;
    }
    function listCommands (Request $rq, Response $rs, array $args):Response{

   
        $commandes = Command::select(['id','mail', 'montant'])->get();
        $rs = $rs->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
        $data =[
            'type'=>'ressource',
            'count'=>count($commandes),
            'commandes'=>$commandes->toArray()
        ];
        $rs->getBody()->write(json_encode($data));
    
    
  
        return  $rs;
    }
    function getCommande (Request $rq, Response $rs, array $args):Response{
        
        $commandes = Command::select(['id','mail', 'nom','montant', 'livraison','created_at'])->where('id','=', $args['id'])->FirstOrFail();
        $rs = $rs->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
        if (isset($_GET['embed'])){
            $items=$_GET['embed'];
        }else{
            $items="";
        }
        
        if ($items =='items'){
            $items_info = $commandes->getItem()->get(['id','libelle','tarif','quantite']);
            $data =[
                'type'=>'ressource',
                'commande'=>$commandes->toArray(),
                'items'=>$items_info->toArray(),
                'links'=>[
                    'items'=>[
                        'href'=>'/commande/'.$commandes['id']."/items"
                    ],
                    'self'=>[
                        'href'=>'/commande/'.$commandes['id']
                    ]
                ],
            ];
        }else{
            $data =[
                'type'=>'ressource',
                'commande'=>$commandes->toArray(),
                'links'=>[
                    'items'=>[
                        'href'=>'/commande/'.$commandes['id']."/items"
                    ],
                    'self'=>[
                        'href'=>'/commande/'.$commandes['id']
                    ]
                ],
            ];
        }
       
        $rs->getBody()->write(json_encode($data));
        return  $rs;
    }
    function addCommande (){
        $uuid = Str::uuid()->toString();
       
        $new_commande = new Command();
        $new_commande->id=$uuid;
        $new_commande->livraison='2022-01-31 20:00:00';
        $new_commande->nom='Thibault.Amagat';
        $new_commande->mail='monmail@monservice.com';
        $new_commande->montant=10.00;
        $new_commande->token="b2067acd19f205577d707604751449f251556a80fefdc186e1e88e08eb477959";
        $new_commande->status=5;

        $new_commande->save();
        // $data =[
        //     'type'=>'collection',
        //     'count'=>count($items),
        //     'items'=>$items->toArray()
        // ];

        // return  $rs;
    }
    
   /* function replaceCommande (Request $rq, Response $rs, array $args):Response{
      
            $command_data=getParsedBody();

        if (!isset($command_data['nom_client'])){
            return Writer::json_error($rs, 400, "missing data : nom_client");
        }
        if (!isset($command_data['mail_client'])){
            return Writer::json_error($rs, 400, "missing data : mail_client");
        }
        if (!isset($command_data['livraison']['date'])){
            return Writer::json_error($rs, 400, "missing data : livraison date");
        }
        if (!isset($command_data['livraison']['heure'])){
            return Writer::json_error($rs, 400, "missing data : livraison heure");
        }
        $c = Command::select(['id','nom','mail', 'livraison'])->findOrFail($args['id']);
        $c->nom=filter_var($command_data['nom_client'],FILTER_SANITIZE_SRTING);
        $c->mail=filter_var($command_data['mail_client'],FILTER_SANITIZE_EMAIL);
        $c->livraison=filter_var($command_data['livraison'],FILTER_SANITIZE_EMAIL);
        
       
    }*/
/*try{

}catch{

}
    $commandes = Command::select(['id','mail', 'montant'])->get() // ->where(id,'=', $id)->FirstOrFail

    $data =[
        'type'=>'ressource',
        'commande'=>$commandes->toArray();
    ]

    
    $rs= $rs->withStatus(200)
*/
}



?>