<?php

declare(strict_types=1);
header( 'content-type: text/html; charset=utf-8' );

//Affichage des erreurs
ini_set("display_errors","1");
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//Autoloader
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';

//pour le chargement automatique des classes d'Eloquent(rep. vendor)
require_once 'vendor/autoload.php';

$loader = new mf\utils\ClassLoader('src');
$loader->register();

//Router
use mf\router\Router as Router;

//Modèles 
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;

//Controllers
use hangarapp\control\HangarController as HangarGestController;
use hangarapp\control\HangarAdminController as HangarAdminController;

//Authentification
use hangarapp\auth\HangarAuthentification as HangarAuthentification;

//Paramètre de connexion issus de config.ini
$config = parse_ini_file("conf/config.ini");

//une instance de connexion
$db = new Illuminate\Database\Capsule\Manager();

//style CSS
\hangarapp\view\HangarGestView::addStyleSheet("html/css/style.css");

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

$new_user = new Producteur();

            $new_user->Nom = "Benoit";
            $new_user->Localisation = "Paris";
            $new_user->Mail = "benoit@mail.com";
            $new_user->Mdp = password_hash("ben",PASSWORD_DEFAULT);
            $new_user->level = 100;        

            //$new_user->save();

$router = new Router();

$router->addRoute('home',
                    '/home/',
                    '\hangarapp\control\HangarGestController',
                    'viewHome',
                    HangarAuthentification::ACCESS_LEVEL_USER);

$router->addRoute('login',
                    '/login/',
                    '\hangarapp\control\HangarAdminController',
                    'login',
                    HangarAuthentification::ACCESS_LEVEL_NONE);

$router->addRoute('check_login',
                    '/check_login/',
                    '\hangarapp\control\HangarAdminController',
                    'CheckLogin',
                    HangarAuthentification::ACCESS_LEVEL_USER);

$router->addRoute('commandes',
                    '/commandes/',
                    '\hangarapp\control\HangarGestController',
                    'viewListeC');
/*
$router->addRoute('productor',
                    '/productor/',
                   '\tweeterapp\control\TweeterController',
                   'viewProductor');*/

$auth = new HangarAuthentification();
//$auth->createUser("Henry", "Marseille", "henry@mail.com", "1999",100);

$router->setDefaultRoute('/login/');
$router->run();
/*
$produit = new Producteur();
$req = $produit::select();
$lignes = $req->get();
//echo $lignes;
*/
$commande = new Commande();
$req = $commande::select('c.Id','c.Montant','Produit.Nom','Panier.Quantite')
            ->from('Commande AS c','Produit', 'Panier')
            ->join('Panier','c.Id','=','Panier.Id_Commande')
            ->join('Produit','Panier.Id_Produit','=','Produit.Id')
            ->where('Produit.Id_Producteur','=','2');
//echo $req->get();



/*Requête SQL
SELECT Commande.Id, Commande.Nom_client 
FROM Commande 
LEFT JOIN Panier ON Commande.Id = Panier.Id_Commande 
LEFT JOIN Produit ON Panier.Id_Produit = Produit.Id 
WHERE Produit.Id_Producteur = 2; */


?>