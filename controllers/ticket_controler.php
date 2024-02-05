<?php
require_once('../models/ticket_model.php');

session_start();

if (isset($_GET['ref'])) {
    $ticket = getTicketByRef($_GET['ref']);
    echo json_encode($ticket);
}

if (isset($_GET['type_demande']) && isset($_GET['type_équipement']) && isset($_GET['user']) && isset($_GET['statut'])) {
    $tickets = getTicketByFiltre($_GET['type_demande'], $_GET['type_équipement'], $_GET['user'], $_GET['statut']);
    echo json_encode($tickets);
}

if (isset($_POST['rejeter'])){
    $ref = modifierTicket($_POST['ref'],'Rejeté');
    $_SESSION['msg'] = "Le ticket ". $ref ." a été rejeté avec succès.";
    header('Location: ../?page=tickets_rejetes');
}

if (isset($_POST['cloturer'])){
    $ref = modifierTicket($_POST['ref'],'Traité');
    $_SESSION['msg'] = "Le ticket ". $ref ." a été traité avec succès.";
    header('Location: ../?page=tickets_traites');
}

if (isset($_POST['creerTicket'])) {
    $ref = addTickets($_POST['type'], $_POST['equipement'], $_SESSION['id_user'], $_POST['description']);
    $_SESSION['msg'] = "Le ticket ". $ref ." a été créé avec succès.";
    header('Location: ../?page=tickets_non_traites');
}

if (isset($_POST['signaler'])) {
    addTickets('Problème technique', $_POST['equipement'], $_SESSION['id_user'], $_POST['description']);
    header('Location: ../?page=tickets_non_traites');
}

?>