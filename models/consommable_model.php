<?php

require_once (__DIR__ ."/../connexion_db.php");

function getConsommables() {
    $req = execSQL(
        'SELECT * FROM consommables ORDER BY désignation ASC', // Tri par ordre alphabétique de la désignation
        array()
    );
    
    return $req;
}

function getConsommablesById($id_equipement) {
    $req = execSQL(
        'SELECT * FROM consommables WHERE id_consommable = ?', // Tri par ordre alphabétique de la désignation
        array($id_equipement)
    );
    
    return $req;
}

?>