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
    public function viewUnProducteur()
    {
        $route = new Router();
        $http_req = new HttpRequest();
        //$idProducteur = $http_req->get['Id'];
        $idProducteur = $id ?? $this->request->get['Id'];
        $producteur = Producteur::find($idProducteur);
        //$producteur = Producteur::all();
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

        $info["produit"] = Produit::select('*')->orderBy('Id_Categorie')->orderBy('nom')->get();
        $info["categorie"] = Categorie::select('*')->orderBy('nom')->get();
        $vueProduit = new HangarView($info);
        echo $vueProduit->render('renderHome');

    }

    public function viewTest(){
        $info = array();
        $a="";
        $b="";
        $tic = false;
        foreach ($_POST as $data)
        {
            $b = $a;
            $a = $data;
            if (($a != 0) && ($tic == true))
            {
                $info[] = array("id"=>$b,"qte"=>$a);
            }
            if ($tic == false)
            {
                $tic = true;
            }
            else
            {
                $tic = false;
            }
        }
        $vue = new HangarView($info);
        echo $vue->render('renderTest');

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
