<?php

require_once('../models/user_model.php');
session_start();

if (isset($_POST['login']) ){
    seconnecter($_POST['email'],$_POST['mdp']);
    header('Location:../');
}

if (isset($_POST['logout']) ){
    session_destroy();
    header('Location:../');
}

if (isset($_POST['new_user']) ){
    creerUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['departement'], $_POST['administrateur'], $_POST['mdp']);
    header("Location:../?page=users");
}

if (isset($_POST['alter_user']) ){
    alterUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['departement'], $_POST['administrateur'], $_POST['mdp'], $_POST['user_id']);
    header("Location:../?page=users");
}

if (isset($_GET['id'])) {
    $user = getUserById($_GET['id']);
    echo json_encode($user);
}

if (isset($_GET['departement'])) {
    $users = getUsersByDepartement($_GET['departement']);
    echo json_encode($users);
}

?>