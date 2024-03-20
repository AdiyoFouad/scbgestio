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

$bdd->exec("CREATE TABLE IF NOT EXISTS `scbgestio`.`historique_mouvement` (
    `id_mouvement` INT NOT NULL AUTO_INCREMENT,
    `id_equipement` INT,
    `id_consommable` INT,
    `type_mouvement` ENUM('ENTREE', 'SORTIE') NOT NULL,
    `quantite` INT NOT NULL,
    `date_mouvement` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `id_utilisateur` INT,
    PRIMARY KEY (`id_mouvement`),
    FOREIGN KEY (`id_equipement`) REFERENCES `equipements` (`id_equipement`) ON DELETE CASCADE,
    FOREIGN KEY (`id_consommable`) REFERENCES `consommables` (`id_consommable`) ON DELETE CASCADE,
    FOREIGN KEY (`id_utilisateur`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE = InnoDB;
");

$bdd->exec("CREATE TABLE IF NOT EXISTS `scbgestio`.`tickets` ( `ref_ticket` VARCHAR(10) NOT NULL , `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP , `id_equipement` INT NOT NULL , `id_user` INT NOT NULL , `statut` ENUM('En cours','Traité','Rejeté') NOT NULL , `description_ticket` VARCHAR(1000) NOT NULL , `type_demande` ENUM('Nouvelle installation','Problème technique','Demande d''assistance') NOT NULL , PRIMARY KEY (`ref_ticket`)) ENGINE = InnoDB;");

function execSQL($sql, $param) {
    global $bdd;
    $req = $bdd->prepare($sql);
    $req->execute($param);
    return $req;
}



function getLastId() {
    global $bdd;
    return $bdd->lastInsertId();
}

function envoyerMail($objet, $msg) {
    // Paramètres du serveur SMTP
    $smtp_server = 'smtp.votreserveur.com';
    $smtp_port = 587;
    $smtp_username = 'votre_adresse@example.com';
    $smtp_password = 'votre_mot_de_passe';

    // Destinataire et contenu de l'e-mail
    $to = 'hadonon@cimmentbouclier.com';
    $subject = $objet;
    $message = $msg;
    $headers = "From: ". $_SESSION['email'] ."\r\n" .
            "Reply-To: hadonon@cimmentbouclier.com\r\n" .
            "X-Mailer: PHP/" . phpversion();

    // Configuration des paramètres SMTP
    ini_set('SMTP', $smtp_server);
    ini_set('smtp_port', $smtp_port);
    ini_set('sendmail_from', $smtp_username);

    // Envoi de l'e-mail
    mail($to, $subject, $message, $headers);

}

?>
