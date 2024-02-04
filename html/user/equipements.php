<?php
include_once("models/equipement_model.php");

$equipements = getEquipementsByUser( $_SESSION['id_user']); // Récupérer les équipements
?>


<div class="container-fluid">

        <div class="container-fluid">
          <h4 class="fw-semibold mb-4">Equipements</h4>
          <hr>
          <div class="card info">
            <div class="card-body ">
              <div class=" d-flex align-items-center">
                <div class="col-4 col-sm-3 col-md-2">
                  <h5 class=" fw-semibold ms-2">Total</h5>
                  <p class="bg-success total d-flex align-items-center justify-content-center">16</p>
                </div>
                <div class="col">
                <h5 class="mt-4">Matériels: <span class="fw-semibold">12</span></h5>
                <h5 class="mt-3">Logiciels: <span class="fw-semibold">4</span></h5>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Type d'équipement</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Désignation</h6>
                        </th>                        
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Caractéristique</h6>
                        </th>                      
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Date d'acquisition</h6>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
                  </table>
                </div>
        </div>
      </div>

      <style>
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

        
  thead,
  tbody tr:nth-child(even) {
    background-color: rgba(45, 45, 45, 0.05);
  }
        
      </style>