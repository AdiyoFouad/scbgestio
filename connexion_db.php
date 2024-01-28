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
function execSQL($sql, $param) {
    global $bdd;
    $req = $bdd->prepare($sql);
    $req->execute($param);
    return $req;
}
?>
