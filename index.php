<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';



$admin = true;

if ($admin) {
  $menu = 'html/admin/menu.php';
  switch ($page) {
    case 'accueil':
        $view = 'html/admin/dashboard.php';
        break;
    
    case 'equipements':
      $view = 'html/admin/equipements.php';
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

    case 'alter_user':
      $view = 'html/admin/alter_user.php';
      break;

    case 'user_plus':
      $view = 'html/admin/user_plus.php';
      break;

    case 'assigner_retirer':
      $view = 'html/admin/assigner_retirer.php';
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
  </div>
  </div>
  
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>

  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/dashboard.js"></script>
</body>

</html>
