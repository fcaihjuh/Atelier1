<?php

namespace mf\auth;


// A verifier si le use fonctionne bien !
use mf\auth\exception\AuthentificationException as AuthentificationException;

class Authentification extends AbstractAuthentification {
    
    
    public function __construct() {
        
        //operation ternaire ou null coalescing possible ?
        if(isset($_SESSION['user_login'])) {
            $this->user_login = $_SESSION['user_login'];
            $this->access_level = $_SESSION['access_level'];
            $this->logged_in = true;
        } else {
            $this->user_login = null;
            $this->access_level = self::ACCESS_LEVEL_NONE;
            $this->logged_in = false;
        }
    }

    public function updateSession($username, $level) {
        $this->user_login = $username;
        $this->access_level = $level;

        $_SESSION['user_login'] = $username;
        $_SESSION['access_level'] = $level;

        $this->logged_in = true;
    }

    // !! Erreur dans l'ennoncé abstract : ce n'est pas access_right mais access_leve
    public function logout() {
        $_SESSION['user_login'] = null;
        $_SESSION['access_level'] = null;

        $this->user_login = null;
        $this->access_level = self::ACCESS_LEVEL_NONE;
        $this->logged_in = false;

        echo("DEBUG >>>> logout OK in Authentification from HangarAdminController"  . "<br>");
        echo ("user (ify nothig, it works) : $this->user_login" . "<br>");
    }

    public function checkAccessRight($requested) {
        $check = ($requested > $this->access_level) ? false : true;
        echo("DEBUG >>> checkAccess : $check \n");
        return $check;
    }


    // !!!!!!!!!!! EMPTY PASSWORD if(isset_password)
    public function login($username, $db_pass, $given_pass, $level) {

        if(!$this->verifyPassword($given_pass, $db_pass)) {
            echo "DEBUG >>> login password verify to FALSE \n";
            $msg_pwd_error = "Wrong password dude";
            throw new AuthentificationException($msg_pwd_error);
        } else {
            echo "DEBUG >>> login password verify to TRUE \n";
            $this->updateSession($username, $level);
        };

    }

    public function hashPassword($password) {
        // mettre algorithm et variables et tout ?
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
*    * @param string : $password, mot de passe non haché (depuis un formulaire)
     * @param string : $hash, le mot de passe haché (depuis BD)
     * @return bool  : vrai si concordance faut sinon
     */
    public function verifyPassword($password, $hash) {
        $verify_password = false;

        if($hash == '')  {
            if($password == $hash) {
                $verify_password = true;
            }
            else{
                $verify_password = false;
            }
        } /*else {
            $verify_password = password_verify($password, $hash);
        }*/
     
        return $verify_password;
    }


}