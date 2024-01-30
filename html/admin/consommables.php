<?php
include_once("models/consommable_model.php");

$consommables = getConsommables();
?>

<div class="container-fluid">
    <div class="container-fluid">
        <h4 class="fw-semibold mb-4">Etat des consommables</h4>
        <hr>

        <div class="card">
            <div class="card-body p-2">
                <!-- Bouton pour ajouter un nouveau consommable -->
                <div class="col d-flex justify-content-end align-items-center">
                    <button type="button" class="btn btn-primary" onclick="showPopup('ajouter')">Ajouter un consommable</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Quantité</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Désignation</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Modèle</h6>
                        </th>
                        <th class="border-bottom-0">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($consommable = $consommables->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class="pl-1"><?php echo $consommable['quantite']; ?></td>
                            <td><?php echo $consommable['designation']; ?></td>
                            <td><?php echo $consommable['modele']; ?></td>
                            <td><button class="btn btn-light float-right m-0" onclick="showPopup('modifier', <?php echo $consommable['id_consommable']; ?>)">Modifier</button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Contenu de popup1 -->
        <div id="popup1" class="popup">
            <button class="btn btn-danger fs-5 d-flex justify-content-center align-items-center" id="fermer" onclick="hidePopup()">
                <i class="ti ti-x fs-5 fw-bolder"></i>
            </button>
            <!-- Formulaire d'ajout/modification de consommable -->
            <form action="controllers/consommable_controller.php" method="post">
                <h5 class="text-center">Ajouter/Modifier un consommable</h5>
                <hr>
                <!-- Champs du formulaire -->
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" required>
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Désignation</label>
                    <input type="text" class="form-control" id="designation" name="designation" required>
                </div>
                <div class="mb-3">
                    <label for="modele" class="form-label">Modèle</label>
                    <input type="text" class="form-control" id="modele" name="modele" required>
                </div>
                <!-- ... autres champs du formulaire ... -->
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" name="ajouter_consommable" class="btn btn-primary mt-3">Ajouter/Modifier</button>
                </div>
            </form>
        </div>
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
        color: #fff;
    }

    .card.info {
        height: 125px;
        padding-top: 10px;
    }

    .info .card-body {
        padding-top: 0;
    }

    p.total {
        border-radius: 50%;
        height: 70px;
        width: 70px;
        color: #ffffff;
        font-weight: bold;
        font-size: 2.2rem;
        margin-bottom: 0;
    }

    thead,
    tbody tr:nth-child(even) {
        background-color: rgba(45, 45, 45, 0.05); /* couleur du texte sur la ligne impaire */
    }

    .popup {
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
    function showPopup(action, consommableId = null) {
        // Afficher le popup
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('popup1').style.display = 'block';

        // Effacer les champs du formulaire si l'action est "ajouter"
        if (action === 'ajouter') {
            document.getElementById('quantite').value = '';
            document.getElementById('designation').value = '';
            document.getElementById('modele').value = '';
            // Effacez d'autres champs au besoin
        }

        // Vous pouvez également pré-remplir le formulaire si l'action est "modifier" avec les informations du consommable
        if (action === 'modifier' && consommableId !== null) {
            // Utilisez consommableId pour récupérer les informations du consommable à modifier
            // Puis, remplissez les champs du formulaire avec ces informations
        }
    }

    function hidePopup() {
        // Cacher le popup
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('popup1').style.display = 'none';
    }
</script>
