<?php

namespace hangarapp\model;

class Gerant extends \Illuminate\Database\Eloquent\Model
{

       protected $table      = 'Gerant';  /* le nom de la table */
       protected $primaryKey = 'id';     /* le nom de la clé primaire */
       public    $timestamps = false;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */   
}