<?php
require_once(__DIR__ . "/../connexion_db.php");


function getHistoriqueMouvement() {
    $req = execSQL('
        SELECT hm.*, u.nom, u.departement, u.prenom, e.type_équipement, e.caractéristique, c.modèle, e.désignation AS equipement_designation, c.désignation AS consommable_designation
        FROM historique_mouvement hm
        LEFT JOIN users u ON hm.id_utilisateur = u.id_user
        LEFT JOIN equipements e ON hm.id_equipement = e.id_equipement
        LEFT JOIN consommables c ON hm.id_consommable = c.id_consommable
        ORDER BY hm.date_mouvement DESC
    ', array());

    return $req->fetchall();
}




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