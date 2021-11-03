<?php
namespace Control;

class Data
{
    /**
     * Gestion de la connexion avec la bdd
     *
     * @return     PDO   ( Un objet permettant la connexion )
     */
    function connexionPDO()
    {
        // Récupération des informations du fichier de configuration
        $data = file_get_contents('../config.json', FILE_USE_INCLUDE_PATH);
        $config = json_decode($data); 
        $login = $config[0]->login;
        $mdp = $config[0]->mdp;
        $bd = $config[0]->bd;
        $serveur = $config[0]->serveur;

        // Connexion à la bdd
           try
        {
            $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        // Si la connexion a échouée
        catch (PDOException $e)
        {
            print "Erreur de connexion PDO ";
            die();
        }
    }
}

?>