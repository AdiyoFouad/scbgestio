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
        $_SESSION['msg'] = "Vous interragissez en tant que ". $res[2] . " " . $res[3];
    }else {
        $_SESSION['msg_r'] = "Identifiant incorrect. Veuillez réessayez!";
    }
}

function getUsers(){
    $req = execSQL(
        'SELECT * FROM users',
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

function getUserById($user_id){
    $req = execSQL(
        'SELECT * FROM users WHERE id_user = ?',
        array($user_id)
    );
    $res = $req->fetch();
    return $res;
}

function getUsersByDepartement($departement){
    $req = $departement =='all'? execSQL(
        'SELECT * FROM users',
        array()
    ) : execSQL(
        'SELECT * FROM users WHERE departement = ?',
        array($departement)
    );
    $res = $req->fetchall();
    return $res;
}

function alterUser($nom, $prenom, $email, $departement, $administrateur, $mdp, $user_id){
    $req = execSQL(
        'UPDATE users SET nom = ?, prenom = ?, email = ?, departement = ?, administrateur = ?, mdp = ? WHERE id_user = ?',
        array($nom, $prenom, $email, $departement, $administrateur, $mdp, $user_id)
    );
}

?>