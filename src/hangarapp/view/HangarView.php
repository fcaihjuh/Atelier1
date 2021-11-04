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
        return "<div class='theme-backcolor1'><h1>Le Hangar</h1>%%NAV%%</div><div class='theme-backcolor2'>";
    }
    
    /* Méthode renderFooter
     *
     * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    private function renderFooter()
    {
        return "</div><div class='theme-backcolor1 tweet-footer'>La super app créée en Licence Pro &copy;2021</div>";
    }

     /* Méthode renderNav
     *
     * Retourne le fragment HTML du menu de naviguation 
     */
    private function renderNav()
    {
        $route = new Router();
        $link_home =$route->urlFor('home');
        $link_login =$route->urlFor('home');
        $link_register =$route->urlFor('home');

        $link_form =$route->urlFor('home');

        $nav = "<div><a href=".$link_home.">🛒</a></div>
        <div><a href=".$link_form.">👤</a></div>";
        return $nav;
    }

    /* Méthode renderHome
     *
     * 
     *  
     */
    
    private function renderHome()
    {

       $displayTweets = "coucou";

         return $displayTweets;


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