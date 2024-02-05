<?php

require_once (__DIR__ . "/../connexion_db.php");

require_once("historique_model.php");

function getConsommables() {
    $req = execSQL(
        'SELECT * FROM consommables ORDER BY désignation ASC',
        array()
    );
    
    return $req;
}


function getNbreConsommables() {
    $req = execSQL(
        'SELECT SUM(quantité) AS quantite FROM consommables',
        array()
    );
    $res = $req->fetchall();
    return $res[0]['quantite'];
}

function getConsommablesById($id_consommable) {
    $req = execSQL(
        'SELECT * FROM consommables WHERE id_consommable = ?', 
        array($id_consommable)
    );
    
    return $req->fetch();
}



function addConsommable($designation, $modele, $quantite) {
    $req = execSQL(
        'INSERT INTO consommables (désignation, modèle, quantité) VALUES (?, ?, ?)', 
        array($designation, $modele, $quantite)
    );

    $id_consommable = getLastId();
    addHistoriqueMouvement(null, $id_consommable, 'ENTREE', $quantite);
    $_SESSION['msg'] = $quantite ." ". $designation ." entré(s) en stock.";
    
    return $req;
}


function updateConsommable($id_consommable, $nouvelle_designation, $nouveau_modele, $nouvelle_quantite) {
    // Récupérer l'ancienne quantité
    $ancienne_quantite = execSQL('SELECT quantité FROM consommables WHERE id_consommable = ?', array($id_consommable))->fetchColumn();

    // Mettre à jour la table consommables
    $req = execSQL(
        'UPDATE consommables SET désignation = ?, modèle = ?, quantité = ? WHERE id_consommable = ?', 
        array($nouvelle_designation, $nouveau_modele, $nouvelle_quantite, $id_consommable)
    );

    // Calculer la différence de quantité
    $difference_quantite = $nouvelle_quantite - $ancienne_quantite;

    // Ajouter une entrée ou une sortie dans l'historique en fonction de la différence de quantité
    if ($difference_quantite < 0) {
        // Il s'agit d'une sortie
        addHistoriqueMouvement(null, $id_consommable, 'SORTIE', abs($difference_quantite));
        $_SESSION['msg'] = abs($difference_quantite) ." ". $nouvelle_designation ." sortie(s) de stock.";
    } elseif ($difference_quantite > 0) {
        // Il s'agit d'une entrée
        addHistoriqueMouvement(null, $id_consommable, 'ENTREE', $difference_quantite);
        $_SESSION['msg'] = $difference_quantite ." ". $nouvelle_designation ." entré(s) en stock.";
    }

    return $req;
}


?>
