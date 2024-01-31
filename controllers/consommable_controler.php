<?php
require_once('../models/consommable_model.php');

if (isset($_POST['ajouter_consommable'])) {
    addConsommable($_POST['designation'], $_POST['modele'], $_POST['quantite']);
    header("Location:../?page=consommables");
}

if (isset($_POST['update_consommable'])) {
    updateConsommable($_POST['consommable_id'], $_POST['designation'], $_POST['modele'], $_POST['quantite']);
    header("Location:../?page=consommables");
}

if (isset($_GET['id'])) {
    $cons = getConsommablesById($_GET['id']);
    echo json_encode($cons);
}

?>