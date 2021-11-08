<?php

namespace hangarapp\control;

use mf\utils\HttpRequest as HttpRequest;
use mf\router\Router as Router;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;
use hangarapp\view\HangarView as HangarView;

class HangarController extends \mf\control\AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function viewCommande()
    {
        $commande = Commande::all();
        $vueCommande = new HangarView($commande);
        echo $vueCommande->render('renderCommande');
    }

    public function viewProducteur()
    {
        $route = new Router();
        $http_req = new HttpRequest();
        $producteur = Producteur::all();
        $vueProducteur = new HangarView($producteur);
        echo $vueProducteur->render('renderProducteur');
    }
    
    public function viewUnProducteur(){
        $route = new Router();
        $http_req = new HttpRequest();
        $idProducteur = $id ?? $this->request->get['Id'];
        $producteur = Producteur::find($idProducteur);
        $vueProducteur = new HangarView($producteur);
        echo $vueProducteur->render('renderUnProducteur');
    }


    public function viewPanier()
    {
        
        //pour trouver les articles et la quantité avec l'id du client
       /* $commande = Commande::select('Commande.Nom_client, Produit.Nom, Panier.Quantite')->leftjoin(
            'Panier'
        )->on(
            'Commande.Id',
            '=',
            'Panier.Id_Commande'
        )->leftjoin(
            'Produit'
        )->on(
            'Panier.Id_Produit',
            '=',
            'Produit.Id'
        )->where(
            'Commande.Id',
            '=',
            1
        )->get();*/
        $vueCommande = new HangarView($commande);
        echo $vueCommande->render('renderPanier');
    }

    public function viewHome(){

        if (isset($_POST))
        {
        $info = array();
        $info_cookie = array();
        $a="";
        $b="";
        $c="";
        $tic = 0;
        foreach ($_POST as $data)
        {
            $c = $b;
            $b = $a;
            $a = $data;
            if (($a != 0) && ($tic == 2))
            {
                $info_cookie[] = array("id"=>$c,"prix"=>$b, "qte"=>$a);
            }
            $tic += 1;
            if ($tic >= 3)
            {
                $tic = 0;
            }
        }
        if (isset($_COOKIE["Panier"]))
        {       
             setcookie("Panier", substr($_COOKIE["Panier"], 0, -1).(ltrim(json_encode($info_cookie), '[')),"",'/');
        }
        else
        {
        setcookie("Panier", json_encode($info_cookie),"",'/');
        }
        }
        $info["produit"] = Produit::select('*')->orderBy('Id_Categorie')->orderBy('nom')->get();
        $info["categorie"] = Categorie::select('*')->orderBy('nom')->get();
        $info["producteur"]= Producteur::select('*')->orderBy('nom')->get();
        $vueProduit = new HangarView($info);
        echo $vueProduit->render('renderHome');

    }


    public function viewValid(){

        $produit = Produit::all();

        $c = new Commande();//ajout de la commande
        $c->Nom_client = isset($_POST['nom']) && !empty($_POST['nom']) ? $_POST['nom'] : null;
        $c->Mail_client = isset($_POST['mail']) && !empty($_POST['mail']) ? $_POST['mail'] : null;
        $c->Montant = 360;
        $c->Tel_client = isset($_POST['num']) && !empty($_POST['num']) ? $_POST['num'] : null;
        $c->Etat = 1;
        $c->save();

        $vueProduit = new HangarView($produit);
        echo $vueProduit->render('renderFinalisation');

    }
}