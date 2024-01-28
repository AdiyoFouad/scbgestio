<?php

require_once (__DIR__ ."/../connexion_db.php");


function seconnecter($email, $mdp) {
    $req = execSQL(
        'SELECT COUNT(*), id_user, nom, prenom, departement, email, administrateur FROM users WHERE email = ? AND mdp = ?',
        array($email, $mdp)
    );
    $res = $req->fetch();
    if ($res[0] == 1) {
        $_SESSION['id_user'] = $res[1];
        $_SESSION['nom'] = $res[2];
        $_SESSION['prenom'] = $res[3];
        $_SESSION['departement'] = $res[4];
        $_SESSION['email'] = $res[5];
        $_SESSION['administrateur'] = $res[6];
    }
}

function getUsers(){
    $req = execSQL(
        'SELECT * FROM users ',
        array()
    );
    return $req;
}

function creerUser($nom, $prenom, $email, $departement, $administrateur, $mdp){
    $req = execSQL(
        'INSERT INTO users(nom, prenom, email, departement, administrateur, mdp) VALUES(?, ?, ?, ?, ?, ? )',
        array($nom, $prenom, $email, $departement, $administrateur, $mdp)
    );
}

?>