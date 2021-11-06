<?php

declare(strict_types=1);

// Affichage des erreurs
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Autoloader
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';

/* pour le chargement automatique des classes d'Eloquent (dans le répertoire vendor) */
require_once 'vendor/autoload.php';

$loader = new \mf\utils\ClassLoader('src');
$loader->register();

// Router
use mf\router\Router as Router;

// Models
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;

// Controllers
use hangarapp\control\HangarController as HangarController;

// Paramètre de connexion issus de conf.ini
$paramsServer = parse_ini_file("conf/config.ini");

/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($paramsServer); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */

$router = new Router();
$router->addRoute(
    'home',
    '/home/',
    '\hangarapp\control\HangarController',
    'viewHome'
);

$router->addRoute(
    'test',
    '/test/',
    '\hangarapp\control\HangarController',
    'viewTest'
);

$router->addRoute(
    'producteur',
    '/producteur/',
    '\hangarapp\control\HangarController',
    'viewProducteur'
);

$router->addRoute(
    'unProducteur',
    '/unProducteur/',
    '\hangarapp\control\HangarController',
    'viewUnProducteur'
);


$router->addRoute(
    'panier',
    '/panier/',
    '\hangarapp\control\HangarController',
    'viewPanier'
);

$router->addRoute(
    'commande',
    '/commande/',
    '\hangarapp\control\HangarController',
    'viewCommande'
);

$router->addRoute(
    'finalisation',
    '/finalisation/',
    '\hangarapp\control\HangarController',
    'viewValid'
);

$router->setDefaultRoute('/home/');

$router->run();

/*$prod = new Produit();
$prod->ajouterProduit(2, 2, 'Prune', 'Bio', 1.9, 'default.png');*/

/*$lp = Categorie::where('Id','=', 3)->first();
$liste_produits = $lp->produits()->first() ;
var_dump($liste_produits);
*/

/*$c = Produit::where('id' ,'=', 5)->first();
$cat = $c->categorie()->first();
echo $cat;*/

/*$produit1 = new Produit();
$produit1->supprimerProduit(23, 2, 2);*/

/*echo "<br>/*************************** Liste des produits ********************* /<br>";
$requete = Produit::select(); 

$lignesP = $requete->get();   /* exécution de la requête et plusieurs lignes résultat */

/*foreach ($lignesP as $p)      /* $p est une instance de la classe Produit */
   /* echo "<br>Identifiant: $p->Id, Nom: $p->Nom, Description: $p->Description <br>" ;

/*$aff = new Produit();*/
/*$aff->AfficherProduit();*/