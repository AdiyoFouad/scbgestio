<?php
require_once('../models/equipement_model.php');

session_start();

if (isset($_POST['new_equipement']) ){
    ajouterEquipement($_POST['type_equipement'], $_POST['designation'], $_POST['date_achat'], $_POST['etat_equipement'], $_POST['duree'], $_POST['caracteristique']);
    $_SESSION['msg'] = $_POST['designation'] . " ajouté au stock.";
    header("Location:../?page=stock");
}

if (isset($_POST['update_equipement_user']) ){
    if ($_POST['action'] == 'assigner') {
        setEquipementUser($_POST['equipement'], $_POST['user']);
        $_SESSION['msg'] = "Equipement assigné avec succès.";
    } else {
        removeEquipementUser($_POST['equipement'], $_POST['user']);
        $_SESSION['msg_r'] = "Equipement retiré avec succès et mis en stock.";
    }
    header("Location:../?page=equipements");
}

if (isset($_POST['setEtat_equipement']) ){
        setEquipementEtat($_POST['equipement'], $_POST['etat_equipement']);
        $_SESSION['msg'] = "Etat modifié avec succès";
        if ($_POST['userme']) {
            header("Location:../?page=equipements");
        } else {
            header("Location:../?page=stock");
        }
        
        
}

if (isset($_GET['type']) && isset($_GET['statut']) ){
    $equipements = getEquipementsEnStockByTypeAndEtat($_GET['type'], $_GET['statut']);
    echo json_encode($equipements);
}

if (isset($_GET['type']) && isset($_GET['etat']) && isset($_GET['departement'])){
    $equipements = getEquipementsAssignésByTypeAndEtatAndDepartement($_GET['type'], $_GET['etat'], $_GET['departement']);
    echo json_encode($equipements);
}

if (isset($_GET['type']) && isset($_GET['user_id'])){
    $equipements = getEquipementsByUserAndType($_GET['user_id'], $_GET['type']);
    echo json_encode($equipements);
}


if (isset($_GET['id_equipement'])){
    $equipements = getEquipementByID($_GET['id_equipement']);
    echo json_encode($equipements);
}



?>