/**
 * @api {get} /auth/ Verification des information de connection
 * @apiName Authentification
 * @apiGroup Authentification
 *
 *
 * @apiHeader (Authorization) {email} username mail de connection d'un utilisateur
 * @apiHeader (Authorization) {password} password mot de passe de l'utilisateur
 * @apiSuccess {Chaine} access_token Access token.
 * @apiSuccess {Chaine} token Token.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
        "access-token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkubGJzLmxvY2FsXC9hdXRoIiwiYXVkIjoiaHR0cDpcL1wvYXBpLmxicy5sb2NhbCIsImlhdCI6MTUxMzY3MTAwMCwiZXhwIjoxNTEzNjc0NjAwLCJjaWQiOjF9.EtE4iY2XIGf_V0Ai9g62D3XU35IFgSJr6n8ja9jOLr7JCdqxG-oTosWwruGT028oFm_6pwQzUHwYBCtyZx4AGQ" ,
        "refresh-token": "A675E34FA7B43109FEC43218FEDD56"
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
 * @api {get} /check/ Verification du token
 * @apiName Check
 * @apiGroup Authentification
 *
 *
 * @apiHeader (Authorization) {String} Bearer access_token delivré par /auth/
 * @apiSuccess {Chaine} email Email de l'utilisateur.
 * @apiSuccess {Chaine} username Nom de l'utilisateur.
 * @apiSuccess {Entier} level Level de l'utilisateur.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 * {
 *  "email": "Michelle.Boucher@live.com",
 *  "username": "Michelle Boucher",
 *  "level": "10",
 * }
 *
 * @apiError (Error 401) NoAuthorizationheader Il n'y a pas de header Authorization
 *
 * @apiErrorExample NoAuthorizationheader-Response:
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "No Authorization header present"
 *   }
 
 * @apiError (Error 401) expired-token Le token a expiré
 * @apiError (Error 401) SignatureInvalidException la signature n'est pas bonne
 * @apiError (Error 401) BeforeValidException . 
 * @apiError (Error 401) ValueUnexpected Un champ est innatendu
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
   @apiError tokenParamNotFound erreur param token inexistant ou invalide.
 *
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