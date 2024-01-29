<?php
require_once('../models/equipement_model.php');

if (isset($_POST['new_equipement']) ){
    ajouterEquipement($_POST['type_equipement'], $_POST['designation'], $_POST['date_achat'], $_POST['etat'], $_POST['duree'], $_POST['caracteristique']);
    header("Location:../?page=stock");
}




?>