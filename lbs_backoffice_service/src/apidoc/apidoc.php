/**
 * @api {get} /auth/ Verification des information de connection
 * @apiName Authentification
 * @apiGroup Backoffice
 *
 *
 * @apiHeader (Authorization) {email} username mail de connection d'un utilisateur
 * @apiHeader (Authorization) {password} password mot de passe de l'utilisateur
 * @apiSuccess {Chaine} access_token Access token.
 * @apiSuccess {Chaine} token Token.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NDg2NTE1ODQsImV4cCI6MTY3OTc1NTU4NCwidXByIjp7Im1haWwiOiJ2YWxlbnRpbkB0ZXN0LmZyIiwibm9tIjoidGVzdCIsInByZW5vbSI6Im51bGwiLCJzZXhlIjoiRiJ9fQ.-Wm-je8ccEoTPe0rorj5FdBmmBB-o-NoD2lON_t1lt3mxuULaCvAFG6Vc5sZZZEQFNvJKaRuEW-vfm2Vyy80cw",
 *      "token": "e3461dc91eb264a2f9bcd0e43db8bb786664c3f926e87743a6d180d079c3722d"
 *     }
 *
 * @apiErrorExample Error-Response:
 * HTTP/1.1 401 Unauthorized
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "Erreur authentification"
 *   }
 * @apiError (Error 401) NoAuthorizationheader Il n'y a pas de header Authorization
 *
 * @apiErrorExample NoAuthorizationheader-Response:
 * HTTP/1.1 401 Unauthorized
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "No Authorization header present"
 *   }
 * @apiError (Error 401) password-check-failed Le mot de passe n'est pas bon
 * @apiErrorExample password-check-failed-Response:
 * HTTP/1.1 401 Unauthorized
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message":  "Erreur authentification. password check failed"
 *   }
 */

/**
 * @api {get} /commandes/ Affichage des commandes
 * @apiName commandes
 * @apiGroup Backoffice
 *
 *
 * @apiHeader (Authorization) {String} Bearer access_token delivré par /auth/
 * @apiSuccess {Chaine} type Type retourné.
 * @apiSuccess {Entier} count Nombre de commande.
 * @apiSuccess {Entier} size Nombre de commande sur une page.
 * @apiSuccess {Objet} links Liens page (suivante, precedente, premiere, derniere).
 * @apiSuccess {Objet} next Page suivante.
 * @apiSuccess {Chaine} href Lien vers une page.
 * @apiSuccess {Objet} prev Page precedente.last
 * @apiSuccess {Objet} last Derniere page.
 * @apiSuccess {Objet} first Premiere page.

 * @apiSuccess {Tableau} commands Liste des commandes
 * @apiSuccess {Objet} command Une commande.
 * @apiSuccess {Chaine} id Identifiant.
 * @apiSuccess {Chaine} nom Nom du proprietaire de la commande.
 * @apiSuccess {DateTime} created_at Date de création de la commande
 * @apiSuccess {DateTime} livraison Date de livraison de la commande.
 * @apiSuccess {Entier} status Premiere page.
 * @apiSuccess {Objet} links Lien vers la commande.
 * @apiSuccess {Objet} self Lien vers la commande.href
 * @apiSuccess {chaine} href Lien vers la commande.

 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 {
       "type": "collection",
       "count": 1502,
       "size": 15,
       "links": {
              "next": {
                     "href": "/commandes/?page=5&size=15"
              },
              "prev": {
                     "href": "/commandes/?page=3&size=15"
              },
              "last": {
                     "href": "/commandes/?page=94&size=15"
              },
              "first": {
                     "href": "/commandes/?page=1&size=15"
              }
       },
       "commands": [ {
              "command": {
                     "id": "30d5909a-a273-4220-a19a-e2c907410ccf",
                     "nom": "Marcel.Renard",
                     "created_at": "2020-12-17 15:09:48",
                     "livraison": "2020-12-17 18:29:01",
                     "status": 5 },
                     "links": {
                     "self": {"href": "/commands/30d5909a-a273-4220-a19a-e2c907410ccf/" }
              }
       },]
 }
 *
 * @apiError (Error 401) NoAccessToken pas d'acces token
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
   @apiError tokenParamNotFound erreur param token inexistant ou invalide.
 *
 * @apiErrorExample Error-Response:
 * HTTP/1.1 401 Unauthorized
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "Erreur authentification"
 *   }
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "No Authorization header present"
 *   }
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "pas d 'access token"
 *   }
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }

 */