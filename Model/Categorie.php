<?php 
namespace model;

class Categorie{
    private $BDD;

    public function __construct(){
        $this->BDD = new Data;
    }


function getCategorieById($id) {
    $resultat = array();

    try
    {
        $cnx = $this->BDD->connexionPDO();
        $req = $cnx->prepare("select * from Categorie where id=:id");
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
?>