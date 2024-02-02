<?php
include_once("models/ticket_model.php");

$tickets = getTickets('Traité'); // Récupérer les utilisateurs
?>

<div class="container-fluid">
    <div class="container-fluid">
        <h4 class="fw-semibold mb-4 justify-content-end">Tickets</h4>
        <hr>
        <div class="card mb-3 p-0">
            <div class="card-body pt-1 pb-0">
                <div id="filtres" class="row">
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Type de demande</label>
                        <select id="type_equipement" class="form-select">
                            <option selected>Tout</option>
                            <option>Nouvelle installation</option>
                            <option>Demande d'assistance</option>
                            <option value="">Problème technique</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Type d'équipement</label>
                        <select id="type_equipement" class="form-select">
                            <option selected>Tout</option>
                            <option>Matériel</option>
                            <option>Logiciel</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Utilisateur</label>
                        <select id="type_equipement" class="form-select">
                            <option selected>Tout</option>
                            <option>Matériel</option>
                            <option>Logiciel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-7">
                <div class="card ">
                    <div style="height:450px; overflow: auto" class="card-body p-0">
                        <table class="table table-striped-custom table-bordered text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ref. Ticket</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Date de création</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Type de demande</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Type d'équipement</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Statut du ticket</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tickets as $ticket): ?>
                                    <tr onclick="remplirDetails('<?php echo $ticket['ref_ticket']; ?>')">
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $ticket['ref_ticket']; ?></h6></td>
                                        <td class="border-bottom-0">
                                            <p class="fw-normal mb-0"><?= $ticket['date_creation']; ?></p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="fw-normal mb-0"><?= $ticket['type_demande']; ?></p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-normal mb-0"><?= $ticket['type_équipement']; ?></h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-success rounded-3 fw-semibold"><?= $ticket['statut']; ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
              <div id="details_tickets" class="card p-0 bg-light">
                <div style="height:450px; overflow: auto" class="card-body pt-0 p-3"><hr>
                <div class="row">
                <h6 class=" col-7 fw-bolder mt-1">Détails du tickets</h6>
                <div class="col-5 d-flex justify-content-end">
                  <span class=" badge bg-success rounded-3 fw-semibold">Traité</span>
                </div>
                </div>
                <hr>
                <span class="fw-semibold">Référence ticket : </span><span id="ref_ticket">T-AEDR78HA</span><br>
                <span class="fw-semibold">Utilisateur : </span><span id="nom"></span><br>
                <span class="fw-semibold">Date de création du ticket : </span><span id="date"></span><br>
                <span class="fw-semibold">Type de demande : </span><span id="type_demande"></span><br><hr>
                <h6 class="text-center fw-bolder">Détails sur l'équipement</h6><hr>
                <span class="fw-semibold">Type de l'équipement : </span><span id="type_équipement"></span><br>
                <span class="fw-semibold">Nom d'équipement : </span><span id="designation"></span><br>
                <hr>
                <h6 class="text-center fw-bolder">Description de la demande</h6><hr>
                <p id="description"></p>
                </div>
              </div>  
            </div>
        </div>
    </div>
</div>

<style>
    thead,
    .table-striped-custom tbody tr:nth-child(even) {
        background-color: rgba(45, 45, 45, 0.05); /* couleur du texte sur la ligne impaire */
    }
</style>

<script>
  function remplirDetails(ref){
    fetch('controllers/ticket_controler.php?ref=' + ref )
        .then(response => response.json())
        .then(ticket => {
          document.getElementById('nom').innerText = ticket['nom'];
            console.log(ticket);
        })
        .catch(error => console.error('Erreur lors de la récupération: ', error));
  }
</script>
