<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="homepage.php" class="nav-link px-2 link-secondary">Acceuil</a></li>
          <li><a href="categorie.php?idc=1" class="nav-link px-2 link-secondary">Véhicules</a></li>
          <li><a href="categorie.php?idc=2" class="nav-link px-2 link-body-emphasis">Mode</a></li>
          <li><a href="categorie.php?idc=3" class="nav-link px-2 link-body-emphasis">Multimédia</a></li>
          <li><a href="categorie.php?idc=4" class="nav-link px-2 link-body-emphasis">Autres</a></li><li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" data-dashlane-rid="4305303233d8c6f7" data-form-type="">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search" data-dashlane-rid="a1c89ee8a98d5b05" data-form-type="">
        </form>
        <button onclick="window.location.href='Assets/scripts/annonces/ajoutProduit.php'" type="button" class="btn btn-warning">Ajouter un produit</button>
        <div class="dropdown text-end">
          <a href="#" class=" ms-3 d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if(isset($_SESSION['user_pp']) && !empty($_SESSION['user_pp'])): ?>
              <img src="<?php echo htmlspecialchars($_SESSION['user_pp'], ENT_QUOTES); ?>" alt="Profil" width="32" height="32" class="rounded-circle">
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu text-small" >
            <li><a class="dropdown-item" href="mesAnnonces.php">Mes annonces</a></li>
            <li><a class="dropdown-item" href="#">Parametres</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="scripts/disconnect.php">Se deconnecter</a></li>
            
          </ul>
        </div>
      </div>
    </div>
  </header>