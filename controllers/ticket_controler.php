<?php
require_once('../models/ticket_model.php');

if (isset($_GET['ref'])) {
    $ticket = getTicketByRef($_GET['ref']);
    echo json_encode($ticket);
}

if (isset($_GET['type_demande']) && isset($_GET['type_équipement']) && isset($_GET['user']) && isset($_GET['statut'])) {
    $tickets = getTicketByFiltre($_GET['type_demande'], $_GET['type_équipement'], $_GET['user'], $_GET['statut']);
    echo json_encode($tickets);
}

?>