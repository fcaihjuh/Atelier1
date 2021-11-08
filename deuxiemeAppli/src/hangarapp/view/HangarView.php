<?php

namespace hangarapp\view;

use mf\router\Router as Router;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;
//use hangarapp\view\HangarView as HangarView;
use mf\view\AbstractView as AbstractView ;

class HangarView extends AbstractView 
{
  
    /* Constructeur 
    *
    * Appelle le constructeur de la classe parent
    */
    public function __construct( $data )
    {
        parent::__construct($data);
    }

    /* Méthode renderHeader
     *
     *  Retourne le fragment HTML de l'entête (unique pour toutes les vues)
     */ 
    private function renderHeader()
    {
        return "<div class=\"main_container\"><h1>Le Hangar</h1>%%NAV%%";
    }
    
    /* Méthode renderFooter
     *
     * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    private function renderFooter()
    {
        return "</div>";
    }

     /* Méthode renderNav
     *
     * Retourne le fragment HTML du menu de naviguation 
     */
    private function renderNav()
    {
        $route = new Router();
        $link_panier =$route->urlFor('panier');
        $link_login =$route->urlFor('home');
        $link_register =$route->urlFor('home');

        $link_form =$route->urlFor('home');

        $nav = "<div class=\"nav_bar\">
    <div id=\"btn_panier\">
        <a href=".$link_panier.">🛒</a>
    </div>
    <div id=\"btn_connexion\">
        <a href=".$link_form.">👤</a>
    </div></div>";
        return $nav;
    }


    
    private function renderHome()
    {
        $route = new Router();

        $produits = $this->data["produit"];
        $categories = $this->data["categorie"];
        $producteurs = $this->data["producteur"];
        $displayProduits= "";
        $displayProduits .= "<form action=\"/Atelier1/main/home/\" method=\"POST\"><div class=\"container_produit\">";

        foreach ($categories as $categorie)
        {
            $displayProduits .= "<div class=\"container_categorie\">";
            $displayProduits .= "<h1>$categorie->Nom</h1>";

        foreach ($produits as $produit)
        {
            foreach($producteurs as $producteur){
          $link_producteur =$route->urlFor('unProducteur',[['Id',"$producteur->Id"]]);            
            if ($produit->Id_Categorie == $categorie->Id)
            {
                if ($produit->Id_Producteur == $producteur->Id){
            $displayProduits .= "<div class=\"list_produit\">
            $produit->Nom
        <div class=\"info_produit\">
            <div class=\"cell_produit\">
                    <img class=\"photo_produit\" src=\"/lehangar/html/img/$produit->Photo\" alt=\"Image of $produit->Nom\">
                </div>
                <div class=\"cell_produit\">
                    <ul>
                        <li>Info: $produit->Description</li>
                        <li> <a href=" . $link_producteur .">  $producteur->Nom</a></li>
                        <li>Prix/Unité : $produit->Tarif_Unitaire</li>
                        <li><input style=\"display:none\" type=\"text\" value=\"$produit->Id\" name=\"valueOf$produit->Id\"></li>
                        <li><input style=\"display:none\" type=\"text\" value=\"$produit->Tarif_Unitaire\" name=\"PriceOf$produit->Id\"></li>
                        <li><input type=\"number\" value=\"0\" name=\"$produit->Id\"></li>
                        <li><input type=\"submit\"value=\"ADD\"></li>
                    </ul>
                </div>
        </div>
    </div>\n";

            }
        }
        }
    }
        $displayProduits .= "</div>";
        }
        $displayProduits .= "</div>";

        return $displayProduits;
        
    }

    public function renderProducteur()
  {
    $route = new Router();
    $producteurs = $this->data;
    $html =  "<div style='font-weight: bolder'>Producteurs</div>";
    foreach ($producteurs as $producteur) {
      $link_producteur = $route->urlFor('unProducteur', [['Id', "$producteur->Id"]]);
      $html .= "
         <div class='producteur-nom''><div><a href=" . $link_producteur . "> $producteur->Nom  </a></div>
   </div>";
    }

    return $html;
  }

    private function renderUnProducteur(){
        $route = new Router();
        //var_dump($this->data);
        $producteur = $this->data;
        $html =  "<div style='font-weight: bolder'>Information du producteur: </div>";
             $html .= "
             <div class='producteur-nom'> $producteur->Nom </a></div>
             <div class='producteur-localisation'>Localisation:  $producteur->Localisation \n</div>
             <div class='producteur-desc'>$producteur->Mail \n</div>
             </div>
     ";

 
          return $html;
 
     }

     private function renderPanier()
  {

    

    $displayPanier = "
        <div class='container'>  
        <form action=\"/lehangar/main.php/commande/\" method=\"POST\"><div class=\"container_produit\">
                      <class='titre_panier'><h2>Mon panier<h2>        
                        <hr><br>
                            <h3>Mes articles</h3>
                            </div> 
                            <div class='prix'><strong> </strong></div>
                        <hr><br>
                <div class='card-action'>
                  <button><a href='{{ URL:previous() }}'>Continuer mes achats</button></button>
                  <button type='submit'>Commander</button>
                  
                </div>
            </div>
        ";
    return $displayPanier;
  }

  public function renderCommande()
  {
    $route = new Router();
    $commandes = $this->data;
    $html =  "<div style='font-weight: bolder'>Mes commandes</div>";
    foreach ($commandes as $commande) {
      //$link_commande =$route->urlFor('commande',[['id',"$commande->Id"]]);
      $html .=/*"
             <div class='commande-id'><div><a href=" . $link_commande ."> $commande->Id </a></div>"*/
        "
             <div class='commande-nomclient'>Nom du client :  $commande->Nom_client \n</div>
             <div class='commande-mailclient'>Mail du client : $commande->Mail_client \n</div>
             <div class='commande-telclient'>Telephone : $commande->Tel_client \n</div>
             <div class='commande-montant'>Montant :$commande->Montant \n</div>
             <div class='commande-etat'>Etat : $commande->Etat \n</div>
             </div>
     ";
    }
}

    private  function renderFinalisation()
  {
    $display = "<div class= 'commande'> " .
      "<div id = 'valid'>" .
      "Votre commande a bien été enregistrée!" .
      "</br>" .
      "<a href= '/laouer/Atelier1/main.php/home'>Retourner au menu</a>" .
      "</div>" .
      "</div>";

    return $display;
  }
    /* Méthode renderBody
     *
     * Retourne la framgment HTML de la balise <body> elle est appelée
     * par la méthode héritée render.
     *
     */
    
    public function renderBody($selector)
    {

        /*
         * voire la classe AbstractView
         */

        $header = $this->renderHeader();
        $navBar = "";
        $center = "";
        $footer = $this->renderFooter();
        
        // variable $$ au lieu du case ??    
        switch ($selector) {
            case 'renderHome':
                $navBar = $this->renderNav();
                $center = $this->renderHome();
                break;

                case 'renderPanier':
                $center = $this->renderPanier();
                $navBar = $this->renderNav();
                break;

                case 'renderUnProducteur':
                    $center = $this->renderUnProducteur();
                    $navBar = $this->renderNav();
                    break;

                case 'renderCommande':
        $center = $this->renderCommande();
        $navBar = $this->renderNav();
        break;

      case 'renderProducteur':
        $center = $this->renderProducteur();
        $navBar = $this->renderNav();
        break;

      case 'renderUnProducteur':
        $center = $this->renderUnProducteur();
        $navBar = $this->renderNav();
        break;

      case 'renderFinalisation':
        $center = $this->renderFinalisation();
        $navBar = $this->renderNav();
        break;

            default:
                $center = "Pas de fonction view correspondante";
                break;
        }


$body = <<<EOT
${header}
${center}
${footer}
EOT;

        return str_replace("%%NAV%%", $navBar, $body);
        
    }

}