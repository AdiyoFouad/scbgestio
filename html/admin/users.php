<?php

include_once("models/user_model.php");

$users = getUsers(); // Récupérer les utilisateurs

?>

<div class="container-fluid">
    <div class="container-fluid">
        <h4 class="fw-semibold mb-4">Gestion des utilisateurs</h4>
        <hr>
        
        <div class="card mb-3 p-0">
            <div class="card-body  pt-1 pb-0">
                <div id="filtres" class="row">
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Département</label>
                        <select id="type_equipement" class="form-select">
                            <option>Tout</option>
                            <option>DE</option>
                            <option>S/Commercial</option>
                            <option value="">S/Informatique</option>
                        </select>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center mt-2">
                        <button class="btn btn-primary" onclick="showPopup()">Ajouter un utilisateur</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">N°</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nom</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Prénoms</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Département</h6>
                        </th>
                        
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Email</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Mot de passe</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"></h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $users->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $user['id_user']; ?></h6></td>
                            <td class="border-bottom-0">
                                <p class="fw-normal mb-0"><?php echo $user['nom']; ?></p>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal text-wap mb-0"><?php echo $user['prenom']; ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0"><?php echo $user['departement']; ?></h6>
                            </td>
                            
                            <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0"><?php echo $user['email']; ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0"><?php echo $user['mdp']; ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="me-2" href=""><button type="submit" class="btn btn-secondary ">Modifier</button></a>
                                    <a href=""><button type="submit" class="btn btn-danger ">Supprimer</button></a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>

    <div id="popup">
    <button class="btn btn-danger d-flex justify-content-center align-items-center" id="fermer" onclick="hidePopup()">
                  <i class="ti ti-circle-minus"></i>
                    </button>
    <form action="controllers/user_controler.php" method="post">    
      <h5 class="text-center">Ajouter un nouvel utilisateur</h5>
      <hr>

      <div class="">
        <span class="me-3 fw-semibold">Administrateur :</span>
                  <label for="non" class="me-2">
                    <input id="non" type="radio" name="administrateur" value="false" checked>
                    Non
                  </label>

                  <label for="oui" class="me-2 ">
                    <input id="oui" type="radio" name="administrateur" value="true" >
                    Oui
                  </label>
                    </div> 
      
      <div class="mb-3">
                      <label for="nom" class="form-label">Nom</label>
                      <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                      <label for="prenom" class="form-label">Prénom</label>
                      <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="departement" class="form-label">Département</label>
                        <select id="departement" class="form-select" name="departement" required>
                          <option disabled selected>Département</option>
                          <option value="DE">DE</option>
                          <option value="Logistique">Logistique</option>
                          <option value="Comptabilité">Comptabilité</option>
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="mdp" class="form-label">Mot de passe</label>
                      <input type="password" class="form-control" id="mdp"  name="mdp" required>
                    </div>
                    <div class="mb-3">
                      <label for="mdp2" class="form-label">Confirmer mot de passe</label>
                      <input type="password" class="form-control" id="mdp2"  name="mdp2" required>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" name="new_user" class="btn btn-primary w-25 mt-3">Créer</button>
        
                    </div>
                  </form>
</div>

<!-- Overlay pour masquer l'arrière-plan -->
<div id="overlay"></div>
</div>


      <style>

        #fermer {
          position: absolute;
          top: -15px;
          right: -15px;
          border-radius: 100%;
          width: 35px;
          height: 35px;
          color:#fff;
        }
        .card.info{
          height: 125px;
          padding-top:10px;
        }
        .info .card-body{
          padding-top:0 
        }
        p.total{
          border-radius:50%;
          height: 70px;
          width:70px;
          color: #ffffff;
          font-weight : bold;
          font-size: 2.2rem;
          margin-bottom:0;
        }

        thead, tbody tr:nth-child(even) {
      background-color: rgba(45,45,45,0.05); /* couleur du texte sur la ligne impaire */
    }
        
      
        /* Style pour masquer la pop-up par défaut */
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 350px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        /* Style pour masquer l'arrière-plan lorsque la pop-up est affichée */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>

<script>
    // Fonction pour afficher la pop-up
    function showPopup() {
        document.getElementById('popup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    // Fonction pour masquer la pop-up
    function hidePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
</script>