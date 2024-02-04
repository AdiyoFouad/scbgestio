<?php
include_once("models/equipement_model.php");

include_once("models/ticket_model.php");

?>




<div class="container-fluid">
<h4 class="fw-semibold mb-4 justify-content-end">SCB Gestio</h4>
        <hr>
        <div hidden>
  <span id="var_courbe_user"><?php echo  json_encode(getUTicketsParmois($_SESSION['id_user'])); ?></span>
</div>
<div class="row">
      <div class="col-lg-6 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">Aperçu de vos équipements</h5>
              </div>
            </div>
            <div class="d-flex align-items-center mb-2 mb-sm-5">
                      <div id="user_ae"></div>
                    </div>
                    <div class="d-flex">
                    <h5 >Matériels: <span id="var_nbremat" class="fw-semibold"> <?php echo getNbreMaterielByUser($_SESSION['id_user'])[0] ; ?></span> </h5>

                    <span class="ms-3"></span>
                    <h5 >Logiciels: <span id="var_nbrelog" class="fw-semibold"><?php echo getNbreLogicielByUser($_SESSION['id_user'])[0];?></span> </h5>
                    </div>               
          </div>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-strech">
        <div class="row">
          
        <div class="col-lg-6">
              <!-- Yearly Breakup -->
              
              <div class="card  overflow-hidden pb-0 bg-light-warning ">
                <div class="card-body pb-2">
                  <h4 style="font-size: 7.5rem;" class="card-title text-warning text-center fw-semibold"><?php echo count(getUTickets('En cours', $_SESSION['id_user']));?></h4>
                  
                  <p class="text-center text-warning fs-3 mb-9">tickets non traité(s)</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <!-- Yearly Breakup -->
              
              <div class="card overflow-hidden pb-0 bg-light-success">
                <div class="card-body pb-0">
                  <h4 class="card-title mb-9 fw-semibold">Etats des tickets</h4>
                  
                  <div >
                        <span class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                        <p class="d-inline-block">Tickets traités : <span class="fw-bolder"><?php echo count(getUTickets('Traité', $_SESSION['id_user']));?></span></p>
                      </div>
                      <div >
                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                        <p class="d-inline-block">Tickets en cours : <span class="fw-bolder"><?php echo count(getUTickets('En cours', $_SESSION['id_user']));?></span></p>
                      </div>
                      <div >
                        <span class="round-8 bg-warning rounded-circle me-2 d-inline-block"></span>
                        <p class="d-inline-block">Tickets rejetés : <span class="fw-bolder"><?php echo count(getUTickets('Rejeté', $_SESSION['id_user']));?></span></p>
                      </div>
                  
                  
                  <div class="d-flex align-items-center mb-2 mb-sm-5">
                        <div id="breakp"></div>
                      </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 ">
              <!-- Monthly Earnings -->
              <div class="card ">
                <div class="card-body">
                  <div class="row alig n-items-start">
                    <div >
                      <h5 class="card-title mb-9 fw-semibold"> Fréquence de création de tickets </h5>
                      
                    </div>
                  </div>
                </div>
                <div id="freq_t"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>