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
    modifierTicket($_POST['ref'],'Rejeté');
    header('Location: ../?page=tickets_rejetes');
}

if (isset($_POST['cloturer'])){
    modifierTicket($_POST['ref'],'Traité');
    header('Location: ../?page=tickets_traites');
}

if (isset($_POST['creerTicket'])) {
    addTickets($_POST['type'], $_POST['equipement'], $_SESSION['id_user'], $_POST['description']);
    header('Location: ../?page=tickets_non_traites');
}

if (isset($_POST['signaler'])) {
    addTickets('Problème technique', $_POST['equipement'], $_SESSION['id_user'], $_POST['description']);
    header('Location: ../?page=tickets_non_traites');
}

?>