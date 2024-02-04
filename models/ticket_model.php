<?php

require_once (__DIR__ ."/../connexion_db.php");

function genererClePrimaire(){
    $prefixe = 'T-';
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueur = 6;

    do {
        $cle = $prefixe;
        for ($i=0; $i < $longueur; $i++) { 
            $cle .= $caracteres[rand(0, strlen($caracteres)) - 1];
        }
        $req = execSQL(
            'SELECT * FROM tickets WHERE ref_ticket = ?',
            array($cle)
        );
        $res= $req->fetch();
    } while ( $req->rowCount() > 0);
    return $cle;
}


function addTickets($type_demande, $equipement, $user, $description){
    $req = execSQL(
        'INSERT INTO tickets(ref_ticket, id_equipement, id_user, statut, type_demande, description_ticket) VALUES (?, ?, ?, ?, ?, ?)',
        array(genererClePrimaire(), $equipement, $user, 'En cours', $type_demande, $description)
    );
    return $req;
}

function getTickets($statut){
    $req = execSQL(
        '
        SELECT tickets.*, users.nom, users.prenom, equipements.désignation, equipements.type_équipement
        FROM tickets
        INNER JOIN users ON tickets.id_user = users.id_user
        INNER JOIN equipements ON tickets.id_equipement = equipements.id_equipement
        WHERE tickets.statut = ? ORDER BY tickets.date_creation DESC',
        array($statut)
    );
    $res = $req->fetchall();
    return $res;
}

function getUTickets($statut, $user){
    $req = execSQL(
        '
        SELECT tickets.*, users.nom, users.prenom, equipements.désignation, equipements.type_équipement
        FROM tickets
        INNER JOIN users ON tickets.id_user = users.id_user
        INNER JOIN equipements ON tickets.id_equipement = equipements.id_equipement
        WHERE tickets.statut = ? AND tickets.id_user = ? ORDER BY tickets.date_creation DESC',
        array($statut, $user)
    );
    $res = $req->fetchall();
    return $res;
}


function getUTicketsParmois($user){
    $req = execSQL(
        '
        SELECT MONTH(tickets.date_creation) as mois, COUNT(tickets.ref_ticket) as nombre_tickets
        FROM tickets
        WHERE tickets.id_user = ?
        GROUP BY mois',
        array($user)
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


function modifierTicket($ref, $statut){
    $req = execSQL(
        'UPDATE tickets SET statut = ? WHERE ref_ticket = ?',
        array($statut, $ref)
    );
}




?>