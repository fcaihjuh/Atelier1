<?php

namespace hangarapp\control;

use mf\auth\exception\AuthentificationException as AuthentificationException;
use hangarapp\auth\HangarAuthentification as HangarAuthentification;
use hangarapp\view\HangarGestView as HangarGestView;
use hangarapp\model\Producteur as Producteur;
use mf\router\Router as Router;

class HangarAdminController extends \mf\control\AbstractController {
    
    public function login() {
        $view_login = new HangarGestView("");
        $view_login->render("viewLogin");
    }

    public function checkLogin() {

        $router = new Router();
        
        $user_mail = $this->request->post['Mail'];
        $user_password = $this->request->post['Mdp'];
        // print_r(">>>>>> user password ! " . $user_password . "!!!!!!!!!!!!!");
        $hangar_auth = new HangarAuthentification; // Pourquoi pas dans le construct ?
        
        try {
            $hangar_auth->loginUser($user_mail, $user_password);
        } catch (AuthentificationException $emessage) {
            // echo $emessage;
            $router->executeRoute('home');
        }
       

        // Récupérer la liste des commandes si connecté
        
        if($hangar_auth->logged_in) {
            $prod = Producteur::select()->where('Mail','=',"$user_mail")->first();
            $prod_commande = $prod->lesProduits()->get();    ///corrigé folllowedBy
            
            $view_commandes = new HangarGestView($prod_commande);
            $view_commandes->render('viewHome');

        } else {
            echo "Aucune commande chez vous !";
        };

    }


    public function logOut() {
        $hangar_auth = new HangarAuthentification;
        $hangar_auth->logout();

        $route = new Router();
        $route->executeRoute('login');
        
    }
/*
    public function signup() {
        $view_signup = new TweeterView("");
        $view_signup->render("viewSignup");
    }
    public function checkSignup() {
        
        $router = new Router();
        
        $fullname = $this->request->post['fullname'];
        $username = $this->request->post['username'];
        $password = $this->request->post['password'];
        $password_retyped = $this->request->post['password_retyped'];
        $tweeter_auth = new TweeterAuthentification; 
        
        try {
            if($password !== $password_retyped) {
                throw new AuthentificationException("The passwords are not the same !");
            } 
            echo("That's shouldn't be there");
            $tweeter_auth->createUser($username, $password, $password_retyped);
            $router->executeRoute('home');
        } catch (AuthentificationException $emessage) {
            echo $emessage;
            $router->executeRoute('signup');
        }
    }*/
}