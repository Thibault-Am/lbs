<?php

namespace lbs\command\app\middlewares\Token;

class Token {
    function checkToken ( Request $rq, Response $rs, callable $next ) {
            
         
        // récupérer l'identifiant de cmmde dans la route et le token
            $id = $rq->getAttribute('route')->getArgument( 'id');
            $token = $rq->getQueryParam('token', null);

            var_dump($token);
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
}
?>