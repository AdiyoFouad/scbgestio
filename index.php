<?php
session_start();




$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';


$admin = $_SESSION['administrateur'];
//session_destroy();

$user_id = $_SESSION['id_user'] ? $_SESSION['id_user'] : null;


if (!$user_id) {
  header("Location: login.php"); // Redirige vers login.php si l'utilisateur n'est pas spécifié
  exit(); // Assure que le script s'arrête ici pour éviter l'exécution du reste du code
}

if ($admin) {
  $menu = 'html/admin/menu.php';
  switch ($page) {
    case 'accueil':
        $view = 'html/admin/dashboard.php';
        break;
    
    case 'equipements':
      $view = 'html/admin/equipements.php';
      break;

    
    case 'consommables':
      $view = 'html/admin/consommables.php';
      break;

    case 'stock':
      $view = 'html/admin/stock.php';
      break;
    
    case 'historique':
      $view = 'html/admin/historique.php';
      break;

    case 'users':
      $view = 'html/admin/users.php';
      break;

    case 'assigner_retirer':
      $view = 'html/admin/assigner_retirer.php';
      break;

    case 'tickets':
      $view = 'html/admin/tickets.php';
      break;
        
    case 'tickets_non_traites':
      $view = 'html/admin/tickets_non_traites.php';
      break;

    case 'tickets_traites':
      $view = 'html/admin/tickets_traites.php';
        break;

    case 'tickets_rejetes':
      $view = 'html/admin/tickets_rejetes.php';
        break;

    
    
    default:
        break;
}
}
else{
  $menu = 'html/user/menu.php';
  switch ($page) {
    case 'accueil':
        $view = 'html/user/dashboard.php';
        break;
    
    case 'equipements':
      $view = 'html/user/equipements.php';
      break;

    case 'demande_equipement':
      $view = 'html/user/demande_equipement.php';
        break;
    
    case 'signaler_defaillance':
      $view = 'html/user/signaler_defaillance.php';
        break;

    case 'tickets':
      $view = 'html/user/tickets.php';
         break;
        
    case 'tickets_non_traites':
      $view = 'html/user/tickets_non_traites.php';
        break;

    case 'tickets_traites':
      $view = 'html/user/tickets_traites.php';
        break;

    case 'tickets_rejetes':
      $view = 'html/user/tickets_rejetes.php';
        break;

    
    
    default:
        break;
}
}


?>





























<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SCB Gestio</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="manifest" href="manifest.json" />

  <script>
    if('serviceWorker' in navigator){
      navigator.serviceWorker.register('sw.js');
    };
  </script>
</head>

<body>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include_once($menu); ?>
    
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
    <?php include_once('html/header.php'); ?>
    
    
                  
      
    <?php include_once($view); ?>
    <?php

  if(isset($_SESSION['msg']) && $_SESSION['msg'] != "") {
      echo "<div id=\"msgContainer\" class=\"msg w-lg-50 text-center alert alert-success\" role=\"alert\">". $_SESSION['msg'] ."</div>";
    }
    if(isset($_SESSION['msg_r']) && $_SESSION['msg_r'] != "") {
      echo "<div id=\"msgContainer2\" class=\"msg w-lg-50 text-center alert alert-danger\" role=\"alert\">". $_SESSION['msg_r'] ."</div>";
    }

     ?>
  
  </div>
  </div>

  
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>

  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>

  <?php 

if ($admin){
  echo "<script src=\"assets/js/dashboard.js\"></script>";
}else {
  echo "<script src=\"assets/js/dashboard_user.js\"></script>";
}
  
  ?>
  
</body>
<style>
  .msg {
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3000000;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.msg.show {
    opacity: 1; 
}
</style>


<script>
  const msgContainer = document.getElementById('msgContainer');
  if (msgContainer) {
      msgContainer.classList.add('show');
      setTimeout(function () {
          msgContainer.classList.remove('show');
          <?php $_SESSION['msg'] = ""; ?>
      }, 3000);
  }

  const msgContainer2 = document.getElementById('msgContainer2');
  if (msgContainer2) {
      msgContainer2.classList.add('show');
      setTimeout(function () {
          msgContainer2.classList.remove('show');
          <?php $_SESSION['msg_r'] = ""; ?>
      }, 3000);
  }
</script>

</html>
