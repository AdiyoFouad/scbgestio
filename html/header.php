<!--  Header Start -->
<header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <span class="fs-5 fw-semi-bold"><?php echo ($_SESSION['nom'])[0] .". ". $_SESSION['prenom']?></span>    
            <li class="nav-item dropdown">
                
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <!--<a href="." class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Profil</p>
                    </a>-->
                    <a href="." class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-layout-dashboard fs-6"></i>
                      <p class="mb-0 fs-3">Tableau de bord</p>
                    </a>
                    <form action="./controllers/user_controler.php" method="post">
                      <input type="submit" name="logout" class="w-75 btn btn-outline-primary m-4 mb-0 mt-2 d-block" value="Déconnexion">
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->