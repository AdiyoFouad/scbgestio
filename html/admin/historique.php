<?php

include_once("models/historique_model.php");

$historiques = getHistoriqueMouvement();
?>

<div class="container-fluid">
    <div class="container-fluid">
        <h4 class="fw-semibold mb-4">Historique des entrées/sorties</h4>
        <hr>

        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Date</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Type d'équipement</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Qte</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Désignation</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Caractéristique</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"></h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historiques as $historique) : ?>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibol mb-0"><?= date('H:i:s   d/m/Y', strtotime($historique['date_mouvement'])) ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="fw-normal mb-0"><?= $historique['id_consommable'] == null ? $historique['type_équipement'] : 'Consommable' ?></p>
                            </td>
                            <td class="border-bottom-0"><h6 class="text-center fw-semibold mb-0"><?= $historique['quantite'] ?></h6></td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal text-wrap mb-0"><?= $historique['consommable_designation'] . $historique['equipement_designation'] ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0"><?= $historique['caractéristique'] . $historique['modèle'] ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <?php if ($historique['type_mouvement'] == 'ENTREE' && empty($historique['nom'])) : ?>
                                    <h6 class="fw-normal mb-0 d-flex">
                                        <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-left text-success"></i>
                                        </span>entré stock
                                    </h6>
                                <?php elseif ($historique['type_mouvement'] == 'ENTREE' && !empty($historique['nom'])) : ?>
                                    <h6 class="fw-normal mb-0 d-flex">
                                        <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-left text-success"></i>
                                        </span><?= $historique['id_consommable'] != null ? 'sortie stock' : $historique['nom'][0].'. ' . $historique['prenom'] . ' (' . $historique['departement'] . ')' ?> 
                                    </h6>
                                <?php elseif ($historique['type_mouvement'] == 'SORTIE') : ?>
                                    <h6 class="fw-normal mb-0 d-flex">
                                        <span class="me-1 rounded-circle bg-light-warning round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-right text-danger"></i>
                                        </span><?= $historique['id_consommable'] != null ? 'sortie stock' : $historique['nom'][0].'. ' . $historique['prenom'] . ' (' . $historique['departement'] . ')' ?> 
                                    </h6>
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

    thead{
        background-color: rgba(45, 45, 45, 0.15);
        /* couleur du texte sur la ligne impaire */
    }
    tbody tr:nth-child(even) {
        background-color: rgba(45, 45, 45, 0.05);
        /* couleur du texte sur la ligne impaire */
    }

</style>