<?php
$host = 'localhost';
$dbname = 'scbgestio';
$charset = 'utf8';
$username = 'root';
$password = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$bdd->exec("CREATE TABLE IF NOT EXISTS `scbgestio`.`users` ( `id_user` INT NOT NULL AUTO_INCREMENT , `nom` VARCHAR(25) NOT NULL , `prenom` VARCHAR(25) NOT NULL , `email` VARCHAR(25) NOT NULL , `mdp` VARCHAR(8) NOT NULL , `departement` ENUM('DE','Logistique','Commercial','Comptabilité') NOT NULL , `administrateur` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id_user`)) ENGINE = InnoDB");

$bdd->exec("CREATE TABLE IF NOT EXISTS `scbgestio`.`equipements` ( `id_equipement` INT NOT NULL AUTO_INCREMENT , `date_achat` DATE NOT NULL , `type_équipement` ENUM('Logiciel','Matériel') NOT NULL , `etat` ENUM('Bon état','En maintenance','Endommagé') NULL , `durée` INT NULL , `utilisateur` INT NULL , `caractéristique` VARCHAR(50) NOT NULL , `date_assignation` DATE NULL , `désignation` VARCHAR(25) NOT NULL , PRIMARY KEY (`id_equipement`)) ENGINE = InnoDB;");

$bdd->exec("CREATE TABLE IF NOT EXISTS `scbgestio`.`consommables` ( `id_consommable` INT NOT NULL AUTO_INCREMENT , `désignation` VARCHAR(25) NOT NULL , `modèle` VARCHAR(25) NOT NULL , `quantité` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id_consommable`)) ENGINE = InnoDB");

function execSQL($sql, $param) {
    global $bdd;
    $req = $bdd->prepare($sql);
    $req->execute($param);
    return $req;
}
?>
