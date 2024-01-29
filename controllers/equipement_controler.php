<?php
require_once('../models/equipement_model.php');

if (isset($_POST['new_equipement']) ){
    ajouterEquipement($_POST['type_equipement'], $_POST['designation'], $_POST['date_achat'], $_POST['etat_equipement'], $_POST['duree'], $_POST['caracteristique']);
    header("Location:../?page=stock");
}


if (isset($_GET['type']) && isset($_GET['statut']) ){
    $equipements = getEquipementsEnStockByTypeAndEtat($_GET['type'], $_GET['statut']);
    echo json_encode($equipements);
}

if (isset($_GET['type']) && isset($_GET['etat']) && isset($_GET['departement'])){
    $equipements = getEquipementsAssignésByTypeAndEtatAndDepartement($_GET['type'], $_GET['etat'], $_GET['departement']);
    echo json_encode($equipements);
}



?>