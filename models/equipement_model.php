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



function getEquipementsEnStockByTypeAndEtat($type, $etat) {
    // Effectuez ici votre logique pour filtrer les équipements en stock en fonction du type et de l'état
    // Utilisez les paramètres $type et $etat dans votre requête SQL

    $sql = 'SELECT * FROM equipements WHERE utilisateur IS NULL';

    $params = array();

    if ($type !== 'Tout') {
        $sql .= " AND type_équipement = ?";
        $params[] = $type;
    }

    if ($etat !== 'Tout' && $type !== 'Logiciel') {
        $sql .= " AND etat = ?";
        $params[] = $etat;
    }

    // Exécutez la requête SQL avec les paramètres
    $req = execSQL($sql, $params);

    return $req->fetchall();
}


function getEquipementsAssignés(){
    $req = execSQL(
        'SELECT * FROM equipements, users WHERE utilisateur = id_user',
        array()
    );
    return $req;
}


function getEquipementsAssignésByTypeAndEtatAndDepartement($type, $etat, $departement) {
    // Effectuez ici votre logique pour filtrer les équipements en stock en fonction du type, de l'état et du département
    // Utilisez les paramètres $type, $etat et $departement dans votre requête SQL

    $sql = 'SELECT * FROM equipements, users WHERE utilisateur = id_user';

    $params = array();

    if ($type !== 'Tout') {
        $sql .= " AND type_équipement = ?";
        $params[] = $type;
    }

    if ($etat !== 'Tout' && $type !== 'Logiciel') {
        $sql .= " AND etat = ?";
        $params[] = $etat;
    }

    if ($departement !== 'Tout') {
        $sql .= " AND departement = ?";
        $params[] = $departement;
    }

    // Exécutez la requête SQL avec les paramètres
    $req = execSQL($sql, $params);

    return $req->fetchall();
}





?>