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
                        <?php if ($equipement['type_équipement'] == 'Logiciel') : ?>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-semibold"><?php echo "". $equipement['durée'] ." jours"; ?></span>
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
                </tr>
            <?php endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>

<style>
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
                               <span class="fw-semibold">${equipement['durée']} jours</span>
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



</script>