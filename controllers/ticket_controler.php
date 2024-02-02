<?php
require_once('../models/ticket_model.php');

if ($_GET['ref']) {
    $ticket = getTicketByRef($_GET['ref']);
    echo json_encode($ticket);
}

?>