<?php
namespace hangarapp\model;

class Commande extends \Illuminate\Database\Eloquent\Model{

    protected $table      = 'Commande';  /* le nom de la table */
    protected $primaryKey = 'id';     /* le nom de la clé primaire */
    public    $timestamps = false;
}