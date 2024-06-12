<header class="p-3 mb-3 border-bottom">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="homepage.php" class="nav-link px-2 link-body-emphasis">Acceuil</a></li>
        <li><a href="categorie.php?idc=1" class="nav-link px-2 link-body-emphasis">Véhicules</a></li>
        <li><a href="categorie.php?idc=2" class="nav-link px-2 link-body-emphasis">Mode</a></li>
        <li><a href="categorie.php?idc=3" class="nav-link px-2 link-body-emphasis">Multimédia</a></li>
        <li><a href="categorie.php?idc=4" class="nav-link px-2 link-body-emphasis">Autres</a></li>
        <li>
      </ul>

      <!-- Assurez-vous d'inclure Font Awesome si ce n'est pas déjà fait -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="searchResults.php" method="get">
  <div class="input-group">
    <input type="search" class="form-control" name="query" placeholder="Search..." aria-label="Search">
    <button class="btn btn-outline-secondary" type="submit">
      <i class="fas fa-search"></i>
    </button>
  </div>
</form>


      <button onclick="window.location.href='ajoutProduit.php'" type="button" class="btn btn-warning">Ajouter un produit</button>
      <div class="dropdown text-end">
        <a href="#" class=" ms-3 d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <?php if (isset($_SESSION['user_pp']) && !empty($_SESSION['user_pp'])) : ?>
            <img src="images/pp/<?php echo htmlspecialchars($_SESSION['user_pp'], ENT_QUOTES); ?>" alt="Profil" width="32" height="32" class="rounded-circle">
          <?php endif; ?>
        </a>
        <ul class="dropdown-menu text-small">
          <li><a class="dropdown-item" href="mesAnnonces.php">Mes annonces</a></li>
          <li><a class="dropdown-item" href="chatList.php">Mes chats</a></li>
          <li><a class="dropdown-item" href="editProfile.php">Parametres</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="scripts/disconnect.php">Se deconnecter</a></li>

        </ul>
      </div>
    </div>
  </div>
</header>
<script>
  function filterResults() {
  var searchQuery = document.getElementById('searchInput').value.toLowerCase();
  var items = document.querySelectorAll('[data-name]'); // Assurez-vous que vos éléments ont cet attribut

  items.forEach(function(item) {
    var name = item.getAttribute('data-name').toLowerCase();
    item.style.display = name.includes(searchQuery) ? '' : 'none';
  });
}
document.addEventListener('DOMContentLoaded', function() {
  var input = document.querySelector('[name="query"]');
  input.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault();  // Empêche tout comportement par défaut
      // Simule un clic sur le bouton de soumission si vous souhaitez ajouter des validations ou des actions supplémentaires ici
      this.form.submit();
    }
  });
});

</script>