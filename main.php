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

$db->addConnection( $paramsServer ); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */

$router = new Router();
$router->addRoute('home',
                  '/home/',
                  '\hangarapp\control\HangarController',
                  'viewHome');

                
$router->setDefaultRoute('/home/');

$router->run();

/*$prod = new Produit();
$prod->ajouterProduit(2, 2, 'Prune', 'Bio', 1.9, 'default.png');*/

$p = Categorie::where('Id', '=', 2)->first();
$liste_produits = $p->produits()->get() ;
//var_dump($liste_produits);
echo $p->Nom;
foreach($liste_produits as $unp) {
    echo $unp->Nom;
}

$c = Produit::where('id' ,'=', 5)->first();
$cat = $c->categorie()->first();
//echo $cat->Nom;