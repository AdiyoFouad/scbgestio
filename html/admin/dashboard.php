<?php

include_once("models/equipement_model.php");
include_once("models/ticket_model.php");
include_once("models/consommable_model.php");
include_once("models/historique_model.php");

?>



<div class="container-fluid">
    <h4 class="fw-semibold mb-1 justify-content-end">SCB Gestio </h4>
    <hr>

    <div hidden>
  <span id="var_logass"><?php echo  getNbreLogAss(); ?></span>
  <span id="var_logstock"><?php echo getNbreLogStock(); ?></span>
  <span id="var_matass"><?php echo getNbreMatAss(); ?></span>
  <span id="var_matstock"><?php echo getNbreMatStock(); ?></span>
  <span id="var_consommable"><?php echo getNbreConsommables(); ?></span>
  <span id="var_courbe"><?php echo  json_encode(getTicketsParmois()); ?></span>
  <span id="var_es"><?php echo json_encode(getES()); ?></span>
</div>
    <div class="row">
        <div class="col-lg-3">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden bg-light">
                <div class="card-body pt-0 pb-2">
                    <h4 style="font-size: 4.5rem;" class="card-title text-warning text-center fw-semibold"><?php echo count(getTickets('En cours')); ?></h4>
                    <p class="text-center text-warning fs-3">tickets non traité(s)</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <!-- Yearly Breakup -->
            <div class="card">
                <div class="card-body pt-2 pb-3 bg-light-success">
                    <h4 class="card-title mb-2 fw-semibold">Etats des tickets</h4>
                    <div>
                        <span class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                        <p class="d-inline-block mb-2">Tickets traités : <span class="fw-bolder"><?php echo count(getTickets('Traité')); ?></span></p>
                    </div>
                    <div>
                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                        <p class="d-inline-block mb-2">Tickets en cours : <span class="fw-bolder"><?php echo count(getTickets('En cours')); ?></span></p>
                    </div>
                    <div>
                        <span class="round-8 bg-warning rounded-circle me-2 d-inline-block"></span>
                        <p class="d-inline-block mb-2">Tickets rejetés : <span class="fw-bolder"><?php echo count(getTickets('Rejeté')); ?></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body pt-2">
                    <div class="row alig n-items-start">
                        <div>
                            <h5 class="card-title mb-2 fw-semibold"> Fréquence de création de tickets </h5>
                        </div>
                    </div>
                </div>
                <div id="freq_t_a"></div>
            </div>
        </div>

        <div class="m-0 col-lg-6">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Aperçu des entrés/sorties stock</h5>
                        </div>
                    </div>
                    <div id="chart_e_s"></div>
                </div>
            </div>
        </div>

        <div class="m-0 col-lg-6 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Aperçu des équipements</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-2 mb-sm-5">
                        <div id="admin_ae"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-strech">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Monthly Earnings -->
                </div>
            </div>
        </div>
    </div>
</div>
