<?php
include_once("models/equipement_model.php");

$equipements = getEquipementsEnStock(); // Récupérer les utilisateurs
?>

<div class="container-fluid">
    <div class="container-fluid">
        <h4 class="fw-semibold mb-4">Equipements en stock</h4>
        <hr>

        <div class="card mb-3 p-0">
            <div class="card-body  pt-1 pb-0">
                <div id="filtres" class="row">
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Type</label>
                        <select id="type_equipement" class="form-select" onchange="applyFilters()">
                            <option selected>Tout</option>
                            <option>Matériel</option>
                            <option>Logiciel</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="staut_ticket" class="form-label">Etat</label>
                        <select id="statut_ticket" class="form-select" onchange="applyFilters()">
                            <option>Tout</option>
                            <option>Bon état</option>
                            <option>En maintenance</option>
                            <option>Endommagé</option>
                        </select>
                    </div>

                    <div class="col d-flex justify-content-end align-items-center mt-2">
                        <button type="submit" class="btn btn-primary" onclick="showPopup()">Ajouter un équipement</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Qté</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Type</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Désignation</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Caractéristique</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Date d'achat</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Etat / Durée</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- ... (votre code précédent) ... -->
                  <?php foreach ($equipements as $equipement) : ?>
                      <tr>
                          <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo 1; ?></h6></td>
                          <td class="border-bottom-0">
                              <p class="fw-normal mb-0"><?php echo $equipement['type_équipement']; ?></p>
                          </td>
                          <td class="border-bottom-0">
                              <h6 class="fw-normal text-wrap mb-0"><?php echo $equipement['désignation']; ?></h6>
                          </td>
                          <td class="border-bottom-0">
                              <h6 class="fw-normal mb-0"><?php echo $equipement['caractéristique']; ?></h6>
                          </td>
                          <td class="border-bottom-0">
                              <h6 class="fw-normal mb-0"><?php echo $equipement['date_achat']; ?></h6>
                          </td>
                          <td class="border-bottom-0">
                              <?php if ($equipement['type_équipement'] == 'Logiciel') : ?>
                                <div class="d-flex align-items-center gap-2">
                                  <span class="fw-semibold"><?php echo "". $equipement['durée'] ." jours"; ?></span>
                                </div>
                              <?php endif; ?>
                              <?php if ($equipement['etat'] == 'Bon état') : ?>
                                  <div class="d-flex align-items-center gap-2">
                                      <span class="badge bg-success rounded-3 fw-semibold"><?php echo $equipement['etat']; ?></span>
                                  </div>
                              <?php elseif ($equipement['etat'] == 'En maintenance') : ?>
                                  <div class="d-flex align-items-center gap-2">
                                      <span class="badge bg-warning rounded-3 fw-semibold"><?php echo $equipement['etat']; ?></span>
                                  </div>
                              <?php elseif ($equipement['etat'] == 'Endommagé') : ?>
                                  <div class="d-flex align-items-center gap-2">
                                      <span class="badge bg-danger rounded-3 fw-semibold"><?php echo $equipement['etat']; ?></span>
                                  </div>
                              <?php endif; ?>
                          </td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Contenu de popup1 -->
        <div id="popup1" class="popup">
            <button class="btn btn-danger d-flex justify-content-center align-items-center" id="fermer" onclick="hidePopup()">
                <i class="ti ti-circle-minus"></i>
            </button>
            <form action="controllers/equipement_controler.php" method="post" >
              <h5 class="text-center">Ajouter un nouvel équipement</h5>
              <hr>

              <div class="mb-3">
                  <label for="type_equipement2" class="form-label">Type d'équipement</label>
                  <select id="type_equipement2" class="form-select" name="type_equipement" required onchange="toggleFields()">
                      <option disabled selected></option>
                      <option value="Logiciel">Logiciel</option>
                      <option value="Matériel">Matériel</option>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="designation" class="form-label">Désignation</label>
                  <input type="text" class="form-control" id="designation" name="designation" required>
              </div>
              <div class="mb-3">
                  <label for="caracteristique" class="form-label">Caractéristique</label>
                  <input type="text" class="form-control" id="caracteristique" name="caracteristique" required>
              </div>
              <div class="mb-3">
                  <label for="date_achat" class="form-label">Date d'achat</label>
                  <input type="date" class="form-control" id="date_achat" name="date_achat" required>
              </div>
              <div class="mb-3" id="dureeContainer" style="display: none;">
                  <label for="duree2" class="form-label">Durée License logiciel (jours)</label>
                  <input type="number" class="form-control" id="duree2" name="duree">
              </div>
              <div class="mb-3" id="etatContainer" style="display: none;">
                  <label for="etat_equipement2" class="form-label">État matériel</label>
                  <select id="etat_equipement2" class="form-select" name="etat_equipement">
                      <option></option>
                      <option value="Bon état">Bon état</option>
                      <option value="En maintenance">En maintenance</option>
                      <option value="Endommagé">Endommagé</option>
                  </select>
              </div>
              <div class="d-flex justify-content-center align-items-center">
                  <button type="submit" name="new_equipement" class="btn btn-primary w-25 mt-3">Ajouter</button>
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

function toggleFields() {
        var typeEquipement = document.getElementById('type_equipement2').value;
        var dureeContainer = document.getElementById('dureeContainer');
        var etatContainer = document.getElementById('etatContainer');

        console.log(typeEquipement);
        // Afficher ou masquer les champs en fonction du type d'équipement
        if (typeEquipement === 'Logiciel') {
            dureeContainer.style.display = 'block';
            etatContainer.style.display = 'none';
            document.getElementById('etat_equipement2').required = false;
            document.getElementById('duree2').required = true;
        } else if (typeEquipement === 'Matériel') {
            dureeContainer.style.display = 'none';
            etatContainer.style.display = 'block';
            document.getElementById('etat_equipement2').required = true;
            document.getElementById('duree2').required = false;
        } else {
            dureeContainer.style.display = 'none';
            etatContainer.style.display = 'none';
            document.getElementById('etat_equipement2').required = false;
            document.getElementById('duree2').required = false;
        }
    }
    // Fonction pour afficher la pop-up
    function showPopup() {
        document.getElementById('popup1').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    // Fonction pour masquer la pop-up
    function hidePopup() {
        document.getElementById('popup1').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function applyFilters() {
        var type = document.getElementById('type_equipement').value;
        var statut = document.getElementById('statut_ticket').value;

        

        fetch('controllers/equipement_controler.php?type=' + type + '&statut=' +statut)
        .then(response => response.json())
        .then(equipementsData => {
            // Mettre à jour le tableau des utilisateurs avec les données récupérées
            updateEquipementsTable(equipementsData);
            console.log(equipementsData);
        })
        .catch(error => console.error('Erreur lors de la récupération des équipemnts:', error));

        // Pour l'exemple, affichons simplement les valeurs des filtres
        console.log("Type: " + type + ", Statut: " + statut);
    }

    function updateEquipementsTable(equipementsData) {
    // Effacer le tableau actuel
    var tbody = document.querySelector('tbody');
    tbody.innerHTML = '';

    if (equipementsData.length === 0) {
        // Afficher un message si la liste des équipements est vide
        var emptyRow = document.createElement('tr');
        emptyRow.innerHTML = `
            <td colspan="6" class="text-center">Aucun équipement trouvé</td>
        `;
        tbody.appendChild(emptyRow);
    } else {
        // Reconstruire le tableau avec les nouvelles données
        equipementsData.forEach(equipement => {
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="border-bottom-0"><h6 class="fw-semibold mb-0">${1}</h6></td>
                <td class="border-bottom-0"><p class="fw-normal mb-0">${equipement.type_équipement}</p></td>
                <td class="border-bottom-0"><h6 class="fw-normal text-wrap mb-0">${equipement.désignation}</h6></td>
                <td class="border-bottom-0"><h6 class="fw-normal mb-0">${equipement.caractéristique}</h6></td>
                <td class="border-bottom-0"><h6 class="fw-normal mb-0">${equipement.date_achat}</h6></td>
                <td class="border-bottom-0">
                    ${
                        equipement.type_équipement === 'Logiciel'
                            ? `<div class="d-flex align-items-center gap-2"><span class="fw-semibold">${equipement.durée} jours</span></div>`
                            : equipement.etat === 'Bon état'
                                ? `<div class="d-flex align-items-center gap-2"><span class="badge bg-success rounded-3 fw-semibold">${equipement.etat}</span></div>`
                                : equipement.etat === 'En maintenance'
                                    ? `<div class="d-flex align-items-center gap-2"><span class="badge bg-warning rounded-3 fw-semibold">${equipement.etat}</span></div>`
                                    : equipement.etat === 'Endommagé'
                                        ? `<div class="d-flex align-items-center gap-2"><span class="badge bg-danger rounded-3 fw-semibold">${equipement.etat}</span></div>`
                                        : ''
                    }
                </td>
            `;

            tbody.appendChild(newRow);
        });
    }
}



</script>
