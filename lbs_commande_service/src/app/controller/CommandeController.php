<?php

namespace lbs\command\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;
//docker-compose start démarrer le serv url http://api.commande.local:19080/
use  lbs\command\app\models\Command as Command;
use  lbs\command\app\models\Items as Items;
use  lbs\command\app\utils\Writer as Writer;
use  Illuminate\Support\Str;
use \Datetime;
use Respect\Validation\Validator as v;
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

        $embedItems=false;
        $id=$args['id'];
        $embed = $rq->getQueryParam('embed',null);
        
        if($embed === 'items') $embedItems=true;
        try{
            
            $query = Command::select(['id', 'livraison', 'nom', 'mail', 'status', 'montant'])->where('id','=',$id);
          
            if($embedItems){$query=$query->with('items');};
            
            $commande=$query->firstOrFail();
            
            $links = [
                'items'=>[
                    'href'=>'/commande/'.$commande['id']."/items"
                ],
                'self'=>[
                    'href'=>'/commande/'.$commande['id']
                ]
            ];

            $data = [
                'type'=> 'resource',
                'commande' => $commande->toArray(),
                'links' => $links
            ];
           
            $rs = $rs->withStatus(200)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write(json_encode($data));
            return $rs;

        }catch(ModelNotFoundException $e){
            return $rs->getBody()->write("error requete :".$e->getMessage());
        }
    }
    function addCommande (Request $rq, Response $rs, array $command_data):Response{
        $command_data=$rq->getParsedBody();
        
        if (!isset($command_data['nom_client'])){
            return Writer::json_error($rs, 400, "missing data : nom_client");
        }
        if (!isset($command_data['mail_client'])|| !filter_var($command_data['mail_client'],FILTER_SANITIZE_EMAIL)){
            return Writer::json_error($rs, 400, "missing data : mail_client");
        }
        if (!isset($command_data['livraison']['date'])){
            return Writer::json_error($rs, 400, "missing data : livraison date");
        }
            
        if (!isset($command_data['livraison']['heure'])){
            return Writer::json_error($rs, 400, "missing data : livraison heure");
        }
        //VALIDATOR
        if(v::alnum()->validate($command_data['nom_client'])!=true){
            $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write("error incorrect value for:nom_client");
            return $rs;    
        }
        if(v::date('Y-m-d')->validate($command_data['livraison']['date'])!=true||$command_data['livraison']['date']<date("Y-m-d")){
            $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write("error incorrect value for:date");
            return $rs;   
        }
        if(v::email()->validate($command_data['mail_client'])!=true){
            $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write("error incorrect value for:mail_client");
            return $rs;    
        }
     
        if(!isset($command_data['items'])){
            $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write("error array items doesn't exist");
            return $rs;    
        };
        
    

        try{
            $rs = $rs->withStatus(201)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
            $date=new DateTime($command_data['livraison']['date'].' '.$command_data['livraison']['heure']);
            
            $c= new Command();
            $id=Str::uuid()->toString();
            $c->id = $id;
            $c->nom = filter_var($command_data['nom_client'],FILTER_SANITIZE_STRING);
            $c->mail = filter_var($command_data['mail_client'],FILTER_SANITIZE_EMAIL);
            $c->livraison = date_format($date,'Y-m-d H:i');
            $c->status = 5;
            $c->token=bin2hex(random_bytes(32));
            $c->montant=0;
            foreach($command_data['items'] as $item){
                Items::create([
                    'uri' => $item['uri'],
                    'quantite'=>$item['q'],
                    'libelle'=>$item['libelle'],
                    'command_id'=>$c->id,
                    'tarif'=>$item['tarif'],
                ]);


               
                $c->montant+=$item['q']*$item['tarif'];
            
            }
            
            $c->save();


            $rs->getBody()->write(json_encode($c));//erreur DEMANDER AU PROF
            return $rs;
        }catch(\Exception $e){
            $rs = $rs->withStatus(500)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write($e->getMessage());
            return $rs;
        }
        // $uuid = Str::uuid()->toString();
        // $token = random_bytes(32);
        // $token = bin2hex($token);

        // $rs = $rs->withStatus(201)->withHeader( 'Content-Type', 'application/json;charset=utf-8')->withHeader('Location','commande/'.$uuid );

        // $new_commande = new Command();
        // $new_commande->id=$uuid;
        // $new_commande->nom='theo.Antolini';
        // $new_commande->mail='oaihzifoaznf@monservice.com';   
        // $new_commande->livraison='2020-12-30 01:00:00';
        // $new_commande->token=$token;
        // $new_commande->montant=0;
        // $new_commande->status=5;
    
        // $new_commande->save();
        // //getCommande($new_commande->id);
       
        // $rs->getBody()->write(json_encode($new_commande));
        
        // return  $rs;
       
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

}



?>