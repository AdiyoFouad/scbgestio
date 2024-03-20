<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs scbgestio</title>
    <link rel="stylesheet" href= <?php echo "\"" . __DIR__ ."/assets/libs/bootstrap/dist/css/bootstrap.min.css\""; ?> />
</head>
<body>
    <div class="row">
        <div class="col-3">
            <img src="assets/images/logos/favicon.png" width="150px" alt="">
            <p>Direction Informatique</p>
        </div>
        <div class="col text-center">
            <h1>CIMENT BOUCLIER</h1>

        </div>
    </div>
    <h1>LISTE DES USERS</h1>
    <table>
        <thead>
            <th>id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Département</th>
        </thead>
        <tbody>
            <tr>
               <?php
               foreach ($users as $user): ?> 
               <tr>
                <td><?= $user['id_user'] ?></td>
                <td><?= $user['nom'] ?></td>
                <td><?= $user['prenom'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['departement'] ?></td>
               </tr>
               <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
    
  
</body>

</html>