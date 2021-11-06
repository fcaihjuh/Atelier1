<?php

namespace hangarapp\model;

class Produit extends \Illuminate\Database\Eloquent\Model
{
    protected $table      = 'Produit';  /* le nom de la table */
    protected $primaryKey = 'Id';     /* le nom de la clé primaire */
    public $timestamps = false;     /* si vrai la table doit contenir
                                       les deux colonnes updated_at,
                                       created_at */
    public $incrementing = true;


    public function categorie()
    {
        return $this->belongsTo('\hangarapp\model\Categorie', 'Id_Categorie');

        /* 'Categorie'    : le nom de la classe du model lié */
        /* 'Id_Categorie' : la clé étrangère dans la table courante */
    }

    function ajouterProduit($id_prod, $id_cat, $nom, $descr, $tarif_unit, $photo) {
        $p = new Produit();
    $p->Id_Producteur = $id_prod;
    $p->Id_Categorie = $id_cat;
    $p->Nom = $nom;
    $p->Description = $descr;
    $p->Tarif_Unitaire = $tarif_unit;
    $p->Photo = $photo;
    $p->save();
    }

    function supprimerProduit($prod, $producteur, $cat) { //Param correspondent à Id, Id_Producteur, Id_Categorie
        $requete = Produit::where('Id','=', $prod)->where('Id_Producteur','=', $producteur)->where('Id_Categorie','=', $cat)->delete();
    }

    function AfficherProduit() { // à coller dans le controller
        $html = "<ul>";
        $requete = Produit::select();
        $lignes = $requete->get();
        foreach ($lignes as $p){  
            $html.= "<li>Identifiant: $p->Id, Produit: $p->Nom_client, Description: $p->Description, Prix: $p->Tarif_Unitaire, $p->Photo</li>\n" ;
        }
      echo $html;
    }
   
}
