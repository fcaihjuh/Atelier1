<?php
namespace hangarapp\model;

class Produit extends \Illuminate\Database\Eloquent\Model{
    protected $table      = 'produit';  /* le nom de la table */
    protected $primaryKey = 'id';     /* le nom de la clé primaire */
    public    $timestamps = false;     /* si vrai la table doit contenir
                                       les deux colonnes updated_at,
                                       created_at */

    public function categorie() {
        return $this->belongsTo('\hangarapp\model\Categorie', 'Id_Categorie');
                                 
                                        /* 'Categorie'    : le nom de la classe du model lié */
                                        /* 'Id_Categorie' : la clé étrangère dans la table courante */
                                 }
                                 
    

}