<?php

require_once (__DIR__ ."/../connexion_db.php");

require_once("historique_model.php");




function ajouterEquipement($type_equipement, $designation, $date_achat, $etat, $duree, $caracteristique){
    $req = execSQL(
        'INSERT INTO equipements(type_équipement, désignation, date_achat, etat, durée, caractéristique) VALUES (?, ?, ?, ?, ?, ?)',
        array($type_equipement, $designation, $date_achat, $etat, $duree, $caracteristique)
    );

    $id_equipement = getLastId();
    addHistoriqueMouvement($id_equipement, null, 'ENTREE', 1);
}


function getEquipementsEnStock(){
    $req = execSQL(
        'SELECT * FROM equipements WHERE utilisateur IS NULL ORDER BY désignation',
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

    $sql .= " ORDER BY désignation";

    // Exécutez la requête SQL avec les paramètres
    $req = execSQL($sql, $params);

    return $req->fetchall();
}


function getEquipementsAssignés(){
    $req = execSQL(
        'SELECT * FROM equipements, users WHERE utilisateur = id_user ORDER BY désignation',
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

    $sql .= " ORDER BY désignation";
    // Exécutez la requête SQL avec les paramètres
    $req = execSQL($sql, $params);

    return $req->fetchall();
}

function getEquipementsByUserAndType($user_id, $type_equipement){
    $req = execSQL(
        'SELECT * FROM equipements, users WHERE utilisateur = ? AND id_user = ? AND type_équipement = ? ORDER BY désignation',
        array($user_id, $user_id, $type_equipement)
    );
    return $req->fetchall();
}


function setEquipementUser($equipement, $user){
    $req = execSQL(
        'UPDATE equipements SET utilisateur = ?, date_assignation = ? WHERE id_equipement = ?',
        array($user, date('Y-m-d'),$equipement)
    );
    addHistoriqueMouvementWithUser($equipement, null, 'SORTIE', 1, $user);

}

function removeEquipementUser($equipement, $user){
    $req = execSQL(
        'UPDATE equipements SET utilisateur = NULL, date_assignation = NULL WHERE id_equipement = ?',
        array($equipement)
    );
    addHistoriqueMouvementWithUser($equipement, null, 'SORTIE', 1, $user);    
}



?>