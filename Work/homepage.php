<?php
session_start();
 require 'htmlbasics.php';
 require 'connexion.php';

  $query = "SELECT idp, name, price, image FROM product ORDER BY RAND() LIMIT 3";
  $result = mysqli_query($connexion, $query);
  $annonces = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<body data-bs-theme="dark">
<?php
if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){
  include 'scripts/headerc.php'; 
}else{
  include 'scripts/headernc.php';
}
?>
  <title>Acceuil</title>
  <div class="container px-4 py-5" id="Top-announces">
    <h2 class="pb-2 border-bottom">Annonces à la une</h2>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
        <?php foreach ($annonces as $annonce): ?>
        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('<?php echo htmlspecialchars($annonce['image']); ?>'); background-size: cover; opacity: 0.3; ">

                <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                    <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold" style="color: white;"><?php echo htmlspecialchars($annonce['name']); ?></h3>
                    <div class="d-flex justify-content-between">
                        <small class="text-white"><?php echo htmlspecialchars($annonce['price']); ?> €</small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="b-example-divider"></div>
<div class="container py-4">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Rechercher une annonce" id="searchQueryInput">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">Rechercher</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php foreach ($annonces as $annonce): ?>
        <div class="col-md-4 mb-4"data-name="<?php echo strtolower(htmlspecialchars($annonce['name'])); ?>">
            <div class="card">
                <img src="<?php echo htmlspecialchars($annonce['image']); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($annonce['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($annonce['price']); ?> €</p>
                    <!-- Bouton Voir plus avec lien dynamique -->
                    <a href="detailProduit.php?idp=<?php echo htmlspecialchars($annonce['idp']); ?>" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>



  <div class="b-example-divider"></div>
  <script>
document.getElementById('searchButton').addEventListener('click', function() {
    var searchQuery = document.getElementById('searchQueryInput').value.toLowerCase();
    var annonces = document.querySelectorAll('[data-name]');

    annonces.forEach(function(annonce) {
        var name = annonce.getAttribute('data-name');
        if (name.includes(searchQuery)) {
            annonce.style.display = '';
        } else {
            annonce.style.display = 'none';
        }
    });
});
</script>

</body>
</html>