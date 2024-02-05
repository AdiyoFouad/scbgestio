<?php
include_once("models/equipement_model.php");

$equipements = getEquipementsAssignés(); // Récupérer les équipements
?>

<div class="container-fluid">
  <div class="container-fluid">
    <h4 class="fw-semibold mb-4">Equipements assignés</h4>
    <hr>

    <div class="card mb-3 p-0">
      <div class="card-body pt-1 pb-0">
        <div id="filtres" class="row">
          <div class="mb-3 col-6 col-sm-3">
            <label for="type_equipement" class="form-label">Type</label>
            <select id="type_equipement" class="form-select" onchange="applyFilters()">
              <option value="Tout"  selected>Tout</option>
              <option value="Matériel" >Matériel</option>
              <option value="Logiciel" >Logiciel</option>
            </select>
          </div>
          <div class="mb-3 col-6 col-sm-3">
            <label for="etat" class="form-label">Etat</label>
            <select id="etat" class="form-select" onchange="applyFilters()">
              <option value="Tout" >Tout</option>
              <option value="Bon état" >Bon état</option>
              <option value="En maintenance" >En maintenance</option>
              <option value="Endommagé" >Endommagé</option>
            </select>
          </div>
          <div class="mb-3 col-6 col-sm-3">
            <label for="departement" class="form-label">Département</label>
            <select id="departement" class="form-select" onchange="applyFilters()">
              <option value="Tout" selected>Tout</option>
              <option value="DE">DE</option>
              <option value="HSE">HSE</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table text-nowrap mb-0 align-middle">
        <thead class="text-dark fs-4">
          <tr>
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
              <h6 class="fw-semibold mb-0">Utilisateur</h6>
            </th>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">Date d'achat</h6>
            </th>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">Date d'assignation</h6>
            </th>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">Etat</h6>
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($equipements as $equipement) : ?>
                <tr>
                    
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
                        <h6 class="fw-normal mb-0"><?php echo $equipement['nom'] . " " . $equipement['prenom']; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                        <h6 class="fw-normal mb-0"><?php echo $equipement['date_achat']; ?></h6>
                    </td>
                    
                    <td class="border-bottom-0">
                        <h6 class="fw-normal mb-0"><?php echo $equipement['date_assignation']; ?></h6>
                    </td>
                    <td class="border-bottom-0">
                    <?php 
                        $dateAssignation = new DateTime($equipement['date_assignation']);
                        $aujourdHui = new DateTime();
                        $difference = $aujourdHui->diff($dateAssignation);
                        $joursRestants = $equipement['durée'] - $difference->days - 1;

                        if ($equipement['type_équipement'] == 'Logiciel') : ?>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-semibold"><?php echo "$joursRestants jrs restants"; ?></span>
                            </div>
                        <?php else : ?>
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
                        <?php endif; ?>
                    </td>
                    
                    <td><?php if ($equipement['type_équipement'] == 'Matériel') : ?>
                                <div class="d-flex align-items-center gap-2">
                                <button type="submit" class="btn btn-primary me-1" onclick="showme(<?php echo $equipement['id_equipement']; ?>)"></button>
                                    
                                </div>
                              <?php endif; ?>
                            </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

      </table>
    </div>
    
    <div id="popup2" class="popup">
            <button class="btn btn-danger fs-5  d-flex justify-content-center align-items-center" id="fermer" onclick="hideme()">
              <i class="ti ti-x fs-5 fw-bolder"></i>
            </button>
            <form action="controllers/equipement_controler.php" method="post" >
              <h5 class="text-center">Modifier un équipement</h5>
              <hr>

              <input type="text" id="id_equipement" name="equipement" hidden>
              <input type="text" id="userme" name="userme" hidden>

              <div class="mb-3">
                  <label for="type_equipementme" class="form-label">Type d'équipement</label>
                  <select disabled id="type_equipementme" class="form-select" name="type_equipement" required onchange="toggleFields()">
                      <option disabled selected></option>
                      <option value="Logiciel">Logiciel</option>
                      <option value="Matériel">Matériel</option>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="designationme" class="form-label">Désignation</label>
                  <input disabled type="text" class="form-control" id="designationme" name="designation" required>
              </div>
              <div class="mb-3">
                  <label for="caracteristiqueme" class="form-label">Caractéristique</label>
                  <input disabled type="text" class="form-control" id="caracteristiqueme" name="caracteristique" required>
              </div>
              <div class="mb-3">
                  <label for="date_achatme" class="form-label">Date d'achat</label>
                  <input disabled type="date" class="form-control" id="date_achatme" name="date_achat" required>
              </div>
              <div class="mb-3" id="etatContainer" >
                  <label for="etat_equipementme" class="form-label">État matériel</label>
                  <select id="etat_equipementme" class="form-select" name="etat_equipement" required>
                      <option></option>
                      <option value="Bon état">Bon état</option>
                      <option value="En maintenance">En maintenance</option>
                      <option value="Endommagé">Endommagé</option>
                  </select>
              </div>
              <div class="d-flex justify-content-center align-items-center">
                  <button type="submit" name="setEtat_equipement" class="btn btn-primary mt-3">Modifier état</button>
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
    background-color: rgba(45, 45, 45, 0.05);
  }
</style>

<script>


function showme(id){

  document.getElementById('id_equipement').value = id;

  document.getElementById('popup2').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';


  fetch('controllers/equipement_controler.php?id_equipement=' + id)
  .then(response => response.json())
  .then(equipementData => {
      document.getElementById('userme').value = equipementData['utilisateur'];
      document.getElementById('type_equipementme').value = equipementData['type_équipement'];
      document.getElementById('designationme').value = equipementData['désignation'];
      document.getElementById('caracteristiqueme').value = equipementData['caractéristique'];
      document.getElementById('date_achatme').value = equipementData['date_achat'];
      document.getElementById('etat_equipementme').value = equipementData['etat'];
      // Mettre à jour le tableau des utilisateurs avec les données récupérées
      
      console.log(equipementData);
  })
  .catch(error => console.error('Erreur lors de la récupération des équipemnts:', error));

}

function applyFilters() {
        var type = document.getElementById('type_equipement').value;
        var etat = document.getElementById('etat').value;
        var departement = document.getElementById('departement').value;

        

        fetch('controllers/equipement_controler.php?type=' + type + '&etat=' + etat + '&departement=' + departement)
        .then(response => response.json())
        .then(equipementsData => {
            // Mettre à jour le tableau des utilisateurs avec les données récupérées
           updateEquipementsTable(equipementsData);
           console.log(equipementsData);
        })
        .catch(error => console.error('Erreur lors de la récupération des équipemnts:', error));

        // Pour l'exemple, affichons simplement les valeurs des filtres
        console.log("Type: " + type + ", Statut: " + etat + ", Departement: " + departement);
    }

    function updateEquipementsTable(equipementsData) {
    // Effacer le tableau actuel
    var tbody = document.querySelector('tbody');
    tbody.innerHTML = '';

    if (equipementsData.length === 0) {
        var emptyRow = document.createElement('tr');
        emptyRow.innerHTML = '<td colspan="7" class="text-center">Aucun équipement trouvé</td>';
        tbody.appendChild(emptyRow);
        return; // Sortir de la fonction car le tableau est vide
    }
    // Reconstruire le tableau avec les nouvelles données
    equipementsData.forEach(equipement => {
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td class="border-bottom-0">
                <p class="fw-normal mb-0">${equipement['type_équipement']}</p>
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-normal text-wrap mb-0">${equipement['désignation']}</h6>
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-normal mb-0">${equipement['caractéristique']}</h6>
            </td> 
            <td class="border-bottom-0">
                <h6 class="fw-normal mb-0">${equipement['nom']} ${equipement['prenom']}</h6>
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-normal mb-0">${equipement['date_achat']}</h6>
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-normal mb-0">${equipement['date_assignation']}</h6>
            </td>
            <td class="border-bottom-0">
                ${
                    equipement['type_équipement'] === 'Logiciel'
                        ? `<div class="d-flex align-items-center gap-2">
                               <span class="fw-semibold">${calculateDaysRemaining(equipement['date_assignation'], equipement['durée'])} jours restant</span>
                           </div>`
                        : equipement['etat'] === 'Bon état'
                            ? `<div class="d-flex align-items-center gap-2">
                                   <span class="badge bg-success rounded-3 fw-semibold">${equipement['etat']}</span>
                               </div>`
                            : equipement['etat'] === 'En maintenance'
                                ? `<div class="d-flex align-items-center gap-2">
                                       <span class="badge bg-warning rounded-3 fw-semibold">${equipement['etat']}</span>
                                   </div>`
                                : equipement['etat'] === 'Endommagé'
                                    ? `<div class="d-flex align-items-center gap-2">
                                           <span class="badge bg-danger rounded-3 fw-semibold">${equipement['etat']}</span>
                                       </div>`
                                    : ''
                }
            </td>
        `;

        tbody.appendChild(newRow);
    });
}

function calculateDaysRemaining(dateAssignation, duree) {
    // Convertir la date d'assignation en objet Date
    var dateAssignationObj = new Date(dateAssignation);

    // Calculer la date d'expiration en ajoutant la durée en jours
    var expirationDate = new Date(dateAssignationObj.getTime() + duree * 24 * 60 * 60 * 1000);

    // Calculer le nombre de jours restant
    var currentDate = new Date();
    var daysRemaining = Math.floor((expirationDate - currentDate) / (24 * 60 * 60 * 1000));

    return daysRemaining;
}




</script>