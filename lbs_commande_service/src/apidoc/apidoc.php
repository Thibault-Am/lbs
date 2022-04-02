
/**
 * @api {get} /commandes/ Affichage des commandes
 * @apiName commandes
 * @apiGroup Commandes
 *

 * @apiSuccess {Chaine} type Type retourné.
 * @apiSuccess {Entier} count Nombre de commande.
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
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
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
/**
 * @api {get} /commande/{id}[/] Affichage d'une commande
 * @apiName commandes2
 * @apiGroup Commandes
 *
 * @apiParam {Chaine} id Id de la commande.
 * @apiParam {Chaine} Token Token du proprietaire de la commande. 
 
 * @apiSuccess {Chaine} type Type retourné.
 * @apiSuccess {Objet} command La commande.
 * @apiSuccess {Chaine} id Identifiant.
 * @apiSuccess {Chaine} nom Nom du proprietaire de la commande.
 * @apiSuccess {DateTime} created_at Date de création de la commande
 * @apiSuccess {DateTime} livraison Date de livraison de la commande.
 * @apiSuccess {Entier} status Premiere page.
 * @apiSuccess {Objet} links Lien vers la commande.
 * @apiSuccess {Objet} items Lien vers les items de la commande.
 * @apiSuccess {Objet} self Lien vers la commande.href
 * @apiSuccess {chaine} href Lien vers la commande.

 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 {
       "type": "collection",
              "command": {
                     "id": "30d5909a-a273-4220-a19a-e2c907410ccf",
                     "nom": "Marcel.Renard",
                     "created_at": "2020-12-17 15:09:48",
                     "livraison": "2020-12-17 18:29:01",
                     "status": 5 },
              "links": {
                     "items":{"href": "/commands/30d5909a-a273-4220-a19a-e2c907410ccf/items" }
                     "self": {"href": "/commands/30d5909a-a273-4220-a19a-e2c907410ccf/" }
              }
       }
 }
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
   @apiError tokenParamNotFound erreur param token inexistant ou invalide.
 *
 * @apiErrorExample Error-Response:
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
 *     HTTP/1.1 404 tokenParamNotFound
 *     {
 *      "type": "error",
 *       "error": "404",
 *       "message": "erreur param token inexistant ou invalide" 
 *     }
 */
 /**
 * @api {get} /commande/{id}/items Affichage des items d'une commande
 * @apiName commandes3
 * @apiGroup Commandes
 *
 * @apiParam {Chaine} id Id de la commande.


 * @apiSuccess {Entier} id Identifiant de l'item.
 * @apiSuccess {Chaine} libelle Libelle de l'item.
 * @apiSuccess {Double} tarif Tarif de l'item.
 * @apiSuccess {Entier} quantite Quantite de l'item.
 * @apiSuccess {Objet} links Lien vers la commande.
 * @apiSuccess {Tableau} items Items de la commande.
 * @apiSuccess {Objet} item Un item de la commande.

 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 {
       "type": "collection",
       "count":"2",
       "items":[{
              "item": {
                     "id": "3044",
                     "libelle": "le bucheron",
                     "tarif": "6.00",
                     "quantite": "3"
              },
              "item";{
                     "id": "3045",
                     "libelle": "le panini",
                     "tarif": "6.00",
                     "quantite": "3"
              }
       }]
 }
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
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
 */commande
 /**
 * @api {post} /commande Ajouter une commande
 * @apiName commandes4
 * @apiGroup Commandes
 *
 * @apiParam {Chaine} id Id de la commande.

 * @apiBody {chaine} nom_client Nom du client
 * @apiBody {chaine} mail_client Mail du client
 * @apiBody {objet} Livraison Détails livraison
 * @apiBody {date} date Date de livraison
 * @apiBody {heure} heure Heure de livraison
 * @apiBody {tableau} items Liste d'items
 * @apiBody {chaine} uri Uri de l'item
 * @apiBody {entier} q Quantite de l'item
 * @apiBody {chaine} libelle Libelle de l'item
 * @apiBody {double} tarif tarif de l'item


 * @apiSuccess {Entier} nom Nom du client.
 * @apiSuccess {Entier} mail Mail du client.
 * @apiBody {objet} Livraison Détails livraison
 * @apiBody {date} date Date de livraison
 * @apiBody {heure} heure Heure de livraison
 * @apiSuccess {Tableau} items Items de la commande.
 * @apiSuccess {chaine} uri Uri de l'item
 * @apiSuccess {entier} q Quantite de l'item
 * @apiSuccess {chaine} libelle Libelle de l'item
 * @apiSuccess {double} tarif tarif de l'item

 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 {
       "nom" : "jean mi",
       "mail": "jm@gmal.com",
       "livraison" : {
              "date": "7-12-2021",
              "heure": "12:30"
       }
       "items" : [
              { "uri": "/sandwiches/6", "q": 3,"libelle": "panini","tarif": 6.00 },
              { "uri": "/sandwiches/1", "q": 2,"libelle": "bucheron","tarif": 6.00}
       ]
}

 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
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