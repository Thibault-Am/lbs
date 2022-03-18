<?php
/**
 * Created by PhpStorm.
 * User: canals5
 * Date: 18/11/2019
 * Time: 15:27
 */

namespace lbs\auth\app\controller;


use Firebase\JWT\JWT as JWT;
use Firebase\JWT\Key as Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException ;
use Firebase\JWT\BeforeValidException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use lbs\auth\app\models\User;
use lbs\auth\app\utils\Writer;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/**
 * Class LBSAuthController
 * @package lbs\auth\app\controller
 */
class LBSAuthController
{
    private $c; //le conteneur de dépendance de l'application
    
    public function __construct(\Slim\Container $c){
        $this->container=$c;
    }
    public function authenticate(Request $rq, Response $rs, $args): Response {

        if (!$rq->hasHeader('Authorization')) {

            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="commande_api api" ');
            return Writer::json_error($rs, 401, 'No Authorization header present');
        };

        $authstring = base64_decode(explode(" ", $rq->getHeader('Authorization')[0])[1]);   
        list($email, $pass) = explode(':', $authstring);

        try {
            
            $user = User::select('id', 'email', 'username', 'passwd', 'refresh_token', 'level')
                ->where('email', '=', $email)
                ->firstOrFail();
           
            if (!password_verify($pass, $user->passwd)){
                
                throw new \Exception("password check failed");
            }
            unset ($user->passwd);

        } catch (ModelNotFoundException $e) {
            
            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs auth" ');
            return Writer::json_error($rs, 401, 'Erreur authentification');
        } catch (\Exception $e) {
           
            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs auth" ');
            return Writer::json_error($rs, 401, "Erreur authentification. ".$e->getMessage());
        }


        $secret = $this->container->settings['secret'];
        $token = JWT::encode(['iss' => 'http://api.auth.local/auth',
            'aud' => 'http://api.backoffice.local',
            'iat' => time(),
            'exp' => time() + (12 * 30 * 24 * 3600),
            'upr' => [
                'email' => $user->email,
                'username' => $user->username,
                'level' => $user->level
            ]],
            $secret, 'HS512');

            $user->refresh_token = bin2hex(random_bytes(32));
            $user->save();
            $data = [
                'access-token' => $token,
                'refresh-token' => $user->refresh_token
            ];

            return Writer::json_output($rs, 200, $data);


    }

    public function checkValiditeToken(Request $rq, Response $rs, $args){
        
        if (!$rq->hasHeader('Authorization')) {

            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="commande_api api" ');
            return Writer::json_error($rs, 401, 'No Authorization header present');
        };
       

        try {
            $secret = $this->container->settings['secret'];
            $h = $rq->getHeader('Authorization')[0] ;
            $tokenstring = sscanf($h, "Bearer %s")[0] ;
            $token = JWT::decode($tokenstring, new Key($secret,'HS512' ));

            $data=  [
                'email' => $token->upr->email,
                'username' => $token->upr->username,
                'level'=>$token->upr->level
            ];
            
            
        } catch (ExpiredException $e) {
            return Writer::json_error($rs, 401, 'Le token a expiré. error message:'.$e->getMessage());// a tester l'expiration du token
        } catch (SignatureInvalidException $e) {
            return Writer::json_error($rs, 401, 'SignatureInvalidException. error message:'.$e->getMessage());
        } catch (BeforeValidException $e) {
            return Writer::json_error($rs, 401, 'BeforeValidException. error message:'.$e->getMessage());// Comment on teste cette erreur
        } catch (\UnexpectedValueException $e) { 
            return Writer::json_error($rs, 401, 'Valuer unexpected. error message:'.$e->getMessage());
        };
        return Writer::json_output($rs, 200, $data);
        }

}