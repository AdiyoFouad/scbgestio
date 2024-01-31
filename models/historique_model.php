<?php
require_once(__DIR__ . "/../connexion_db.php");


function addHistoriqueMouvement($id_equipement, $id_consommable, $type_mouvement, $quantite) {
    $req = execSQL(
        'INSERT INTO historique_mouvement (id_equipement, id_consommable, type_mouvement, quantite) VALUES (?, ?, ?, ?)',
        array($id_equipement, $id_consommable, $type_mouvement, $quantite)
    );
}

function addHistoriqueMouvementWithUser($id_equipement, $id_consommable, $type_mouvement, $quantite, $id_utilisateur) {
    $req = execSQL(
        'INSERT INTO historique_mouvement (id_equipement, id_consommable, type_mouvement, quantite, id_utilisateur) VALUES (?, ?, ?, ?, ?)',
        array($id_equipement, $id_consommable, $type_mouvement, $quantite, $id_utilisateur)
    );
    
    return $req;
}

?>