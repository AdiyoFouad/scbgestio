<?php

require_once (__DIR__ ."/../connexion_db.php");


function getTickets($statut){
    $req = execSQL(
        '
        SELECT tickets.*, users.nom, users.prenom, equipements.désignation, equipements.type_équipement
        FROM tickets
        INNER JOIN users ON tickets.id_user = users.id_user
        INNER JOIN equipements ON tickets.id_equipement = equipements.id_equipement
        WHERE tickets.statut = ?',
        array($statut)
    );
    $res = $req->fetchall();
    return $res;
}


function getTicketByRef($ref){
    $req = execSQL(
        '
        SELECT tickets.*, users.nom, users.prenom, equipements.désignation, equipements.type_équipement
        FROM tickets
        INNER JOIN users ON tickets.id_user = users.id_user
        INNER JOIN equipements ON tickets.id_equipement = equipements.id_equipement
        WHERE tickets.ref_ticket = ?',
        array($ref)
    );
    $res = $req->fetch();
    return $res;
}

function getTicketByFiltre($type_demande, $type_equipement, $user, $statut) {
    // Initialisez la requête avec la partie fixe
    $sql = '
        SELECT tickets.*, users.nom, users.prenom, equipements.désignation, equipements.type_équipement
        FROM tickets
        INNER JOIN users ON tickets.id_user = users.id_user
        INNER JOIN equipements ON tickets.id_equipement = equipements.id_equipement
        WHERE 1 = 1';  // 1 = 1 est une astuce pour simplifier la construction de la requête

    // Ajoutez des conditions aux filtres fournis
    $params = array();

    if ($type_demande !== 'Tout') {
        $sql .= ' AND tickets.type_demande = ?';
        $params[] = $type_demande;
    }

    if ($type_equipement !== 'Tout') {
        $sql .= ' AND equipements.type_équipement = ?';
        $params[] = $type_equipement;
    }

    if ($user !== 'Tout') {
        $sql .= ' AND users.id_user = ?';
        $params[] = $user;
    }

    if ($statut !== 'Tout') {
        $sql .= ' AND tickets.statut = ?';
        $params[] = $statut;
    }

    // Exécutez la requête avec les conditions ajoutées
    $req = execSQL($sql, $params);
    
    // Récupérez toutes les lignes résultantes
    $res = $req->fetchall();

    return $res;
}


?>