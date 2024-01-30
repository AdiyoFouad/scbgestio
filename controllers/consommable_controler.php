<?php
require_once('../models/consommable_model.php');


if (isset($_GET['id'])) {
    $cons = getConsommablesById($_GET['id']);
    echo json_encode($cons);
}

?>