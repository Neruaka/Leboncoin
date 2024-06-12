<?php
session_start();
require 'htmlbasics.php';
require 'connexion.php';

// Récupération des annonces à la une
$queryTop = "SELECT idp, name, price, image, is_sold FROM product ORDER BY RAND() LIMIT 3";
$resultTop = mysqli_query($connexion, $queryTop);
$topAnnonces = mysqli_fetch_all($resultTop, MYSQLI_ASSOC);

// Récupération des autres annonces en excluant celles à la une et celles vendues
$topIds = join(",", array_map(function($ann) { return $ann['idp']; }, $topAnnonces));
$queryOther = "SELECT idp, name, price, image, is_sold FROM product WHERE idp NOT IN ($topIds) AND is_sold = 0 ORDER BY RAND() LIMIT 9";
$resultOther = mysqli_query($connexion, $queryOther);
$otherAnnonces = mysqli_fetch_all($resultOther, MYSQLI_ASSOC);
?>

<body data-bs-theme="dark">
    <?php
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        include 'scripts/headerc.php';
    } else {
        include 'scripts/headernc.php';
    }
    ?>
    <title>Acceuil</title>

    <div class="container px-4 py-5" id="Top-announces">
        <h2 class="pb-2 border-bottom">Annonces à la une</h2>
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
            <?php foreach ($topAnnonces as $annonce) : ?>
                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('<?php echo htmlspecialchars($annonce['image']); ?>'); background-size: cover;">
                        <div class="overlay" style="background: rgba(0, 0, 0, 0.7); height: 100%;">
                            <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold"><?php echo htmlspecialchars($annonce['name']); ?></h3>
                                <div class="mb-4 auto">
                                    <span class="badge bg-secondary p-2"><?php echo htmlspecialchars($annonce['price']); ?> €</span>
                                    <?php if ($annonce['is_sold']): ?>
                                        <span class="badge bg-danger">Vendu</span>
                                    <?php endif; ?>
                                </div>
                                <?php if (!$annonce['is_sold']): ?>
                                    <a href="detailProduit.php?idp=<?php echo htmlspecialchars($annonce['idp']); ?>" class="btn btn-primary mt-auto">Voir plus</a>
                                <?php endif; ?>
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
    <div class="container under">
        <div class="row">
            <?php foreach ($otherAnnonces as $annonce) : ?>
                <div class="col-md-4 mb-4" data-name="<?php echo strtolower(htmlspecialchars($annonce['name'])); ?>">
                    <div class="card h-100 shadow-lg">
                        <div class="card-cover" style="background-image: url('<?php echo htmlspecialchars($annonce['image']); ?>'); height: 180px; background-size: cover; opacity: 0.7;"></div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mt-auto"><?php echo htmlspecialchars($annonce['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($annonce['price']); ?> €</p>
                            <?php if (!$annonce['is_sold']): ?>
                                <a href="detailProduit.php?idp=<?php echo htmlspecialchars($annonce['idp']); ?>" class="btn btn-primary mt-auto">Voir plus</a>
                            <?php else: ?>
                                <span class="badge bg-danger">Vendu</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="b-example-divider"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('searchButton').addEventListener('click', function() {
                var searchQuery = document.getElementById('searchQueryInput').value.toLowerCase();
                var annonces = document.querySelectorAll('[data-name]');

                annonces.forEach(function(annonce) {
                    if (annonce.getAttribute('data-name').includes(searchQuery)) {
                        annonce.style.display = '';
                    } else {
                        annonce.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>
