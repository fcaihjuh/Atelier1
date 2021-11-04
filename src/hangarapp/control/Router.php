<?php
namespace Control;

use Exception;

Class Router {
    private $_ctrl;
    private $_view;

    public function routeReq() 
    {
        try 
        {
            // chargement automatique des classes
            spl_autoload_register(function($class) { //l'autoload charge les classes du dossier "model"*/
                require_once('Model/'.$class.'.php');
            });

            $url = '';

            //Le controller est inclu selon l'action de l'utilisateur
            if(isset($_GET['url'])) { //s'il y a un parametre url
                $url = explode('/', filter_var($_GET['url'], 
                FILTER_SANITIZE_URL));//recupere tous les parametre de maniere separe de l'url, filtre qui controle ce qui se passe dans le get, securise ce qu'on recupere

                $controller = ucfirst(strtolower($url[0])); //ucfirst=premiere lettre en majuscule, strtolower=le reste en minuscule de l'url 0, url[0] est le premier parametre puisque ça débute à 0
                $controller_class = $controller."Controller"; //correspond à ProduitController par exemple
                $controller_file = "Control/".controller_class.".php";

                if(file_exists($controller_file)) { //si le fichier ..Controller.php existe
                    require_once($controller_file); //on requière à ce même fichier
                    $this->_ctrl = new $controller_class($url); //alors on lance une instance de la classe en recuperant tous les parametre URL 
                } else
                    throw new Exception('Page introuvable'); //on crée une nouvelle exception 
            } else {
                require_once('Control/ValiderController.php'); //a definir //page qui se charge automatiquement
                $this->_ctrl = new ValiderController($url); //a definir //variable URL qui contiendra tous les paramtre URL
            } 
        }
        //gestion des erreurs
        catch(Exception $e)
        {
            $err_msg = $e->getMessage(); //recupere les erreur
            require_once('Vue/vueErreur.php'); //requiere a la page vue erreur puisqu'on a pas besoin de controller

        }
    }
}


?>