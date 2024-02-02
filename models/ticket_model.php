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

?>