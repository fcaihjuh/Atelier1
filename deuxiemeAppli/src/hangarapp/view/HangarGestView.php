<?php

namespace hangarapp\view;

use mf\router\Router as Router;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;

//Vue
//use app\view\HangarGestView as HangarGestView;
use mf\view\AbstractView as AbstractView ;

//Authentification
use hangarapp\auth\HangarAuthentification as HangarAuthentification;

use mf\utils\HttpRequest as HttpRequest;

class HangarGestView extends AbstractView 
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
        return "<div class='theme-backcolor1'><h1>Le Hangar</h1>%%NAV%%</div><div class='theme-backcolor2'>";
    }
    
    /* Méthode renderFooter
     *
     * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    private function renderFooter()
    {
        return "</div><div style='border: 1px solid yellow;text-align:center'>La super app créée en Licence Pro &copy;2021</div>";
    }

     /* Méthode renderNav
     *
     * Retourne le fragment HTML du menu de naviguation 
     */
    private function renderNav()
    {
        $route = new Router();
        $link_commandes =$route->urlFor('commandes');
        $link_home =$route->urlFor('home');
        $link_login =$route->urlFor('home');
        $link_register =$route->urlFor('home');

        $link_form =$route->urlFor('home');

        $nav = "
        <div><a href=".$link_form.">👤</a></div>";
        "<div><a href=".$link_commandes.">Commandes</a></div>";
        return $nav;
    }

    /* Méthode renderHome
     *
     * 
     *  
     */
    
    private function renderHome()
    {
        $route = new Router();
        $route = new Router();
        $link_commandes =$route->urlFor('commandes');
        $txt = "<div><a href=".$link_commandes.">Commandes</a></div>";
        return $txt;
        
       


    
        
    }


  

  
    /* Méthode renderViewTweet 
     * 
     * Réalise la vue de la fonctionnalité affichage d'un tweet
     *
     */
    
    private function renderViewTweet()
    {

        /* 
         * Retourne le fragment HTML qui réalise l'affichage d'un tweet 
         * en particulié 
         * 
         * L'attribut $this->data contient un objet Tweet
         *
         */

        $route = new Router();

        $tweet = $this->data;
        $author = $tweet->author()->first();

        $link_user = $route->urlFor('usertweets',[['id',"$author->id"]]);

        $htmlTweet =
            "<div class='tweet'><div> $tweet->text</div>
             <div class='tweet-author'> <a href=" . $link_user . "> $author->username </a>\n</div>
             <div class='tweet-footer'>Created at $tweet->created_at \n</div>
             <div class='tweet-score'>👍 $tweet->score \n</div></div>";

       return $htmlTweet;
        
    }

    public function renderLogin() {

        $route = new Router();

        $check_login_route = $route->urlFor('check_login');

        $login_form = <<<EOT
            <article class='theme1'><h3>Veuillez vous connecter pour accéder au gestionnaire des commandes</h3><br><br>
                <form id="login" method="post" class="form" action="$check_login_route">    
                    <label> Mail : </label> <br>   
                    <input type="text" name="Mail" id="Mail" class="forms-text" placeholder="Mail">        
                    <br><label> Mot de passe : </label>    <br>
                    <input type="password" name="Mdp" id="Mdp" class="forms-text" placeholder="Mot de passe">    
        
                    <br><input type="submit" name="log" id="log" class="forms-button" value="Valider" >       
                </form>
            </article>
        EOT;

        return $login_form;

    }

    public function renderListeC() {
        $route = new Router();
        $commandes = $this->data;
        $displayCommandes = "<div class='commande' href=><h2>Les commandes</h2>";
        foreach ($commandes as $commande)
        $link_commande =$route->urlFor('commandes',[['Id',"$commande->Id"]]);     
        $html =  "<div style='font-weight: bolder'>Commandes: </div>";
             $html .= "
             <div class='client-nom'> Nom du client:<a href=" . $link_commande ."> $commande->Nom_client </a></div>
             <div class='montant'>Montant:  $commande->Montant \n</div>
             </div>
     ";

 
          return $html;

        $displayCommandes .= "</div>";


        return $displayCommandes;
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
        $center = "";
        $navBar = "";
        $footer = $this->renderFooter();
        
        // variable $$ au lieu du case ??    
        switch ($selector) {
            case 'renderHome':
                $center = $this->renderHome();
                $navBar = $this->renderNav();
                break;
                
            case 'renderLogin':
                $center = $this->renderLogin();
                break;

            case 'renderListeC':
                $center = $this->renderListeC();
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