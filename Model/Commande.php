<?php
namespace model;

class Commande{
    private $BDD;

    public function __construct(){
        $this->BDD = new Data;
    }


function getCommandeById($id) {
    $resultat = array();

    try
    {
        $cnx = $this->BDD->connexionPDO();
        $req = $cnx->prepare("select * from Commande where id=:id");
        $req->bindValue(":id", $id, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        print "Erreur !: " . $e->getMessage();
        die();
    }
return $resultat;
}
}