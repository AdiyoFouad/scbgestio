<?php

require_once (__DIR__ ."/../connexion_db.php");



function ajouterEquipement($type_equipement, $designation, $date_achat, $etat, $duree, $caracteristique){
    $req = execSQL(
        'INSERT INTO equipements(type_équipement, désignation, date_achat, etat, durée, caractéristique) VALUES (?, ?, ?, ?, ?, ?)',
        array($type_equipement, $designation, $date_achat, $etat, $duree, $caracteristique)
    );
}


function getEquipementsEnStock(){
    $req = execSQL(
        'SELECT * FROM equipements WHERE utilisateur IS NULL',
        array()
    );
    return $req;
}


?>