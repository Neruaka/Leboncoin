<?php
session_start();
require 'htmlbasics.php';
require 'connexion.php';

$userId = isset($_SESSION['user_id']) ? mysqli_real_escape_string($connexion, $_SESSION['user_id']) : null; // Secure the user ID

// Récupérer la requête de recherche depuis l'URL ou le formulaire
$queryString = isset($_GET['query']) ? $_GET['query'] : '';

// Nettoyer la chaîne de recherche pour éviter les injections SQL
$queryString = mysqli_real_escape_string($connexion, $queryString);

// Construct the SQL query using LIKE to search for matches, excluding the user's own products
$query = "SELECT idp, name, price, image, is_sold FROM product WHERE (name LIKE '%" . $queryString . "%' OR description LIKE '%" . $queryString . "%') AND idu != '$userId'";

$result = mysqli_query($connexion, $query);

// Vérifier si des résultats ont été trouvés
$searchResults = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }
}
?>

<body data-bs-theme="dark">
    <?php
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        include 'scripts/headerc.php';
    } else {
        include 'scripts/headernc.php';
    }
    ?>
    <title>Résultats de recherche</title>

    <div class="container py-5">
        <h2>Résultats pour "<?php echo htmlspecialchars($queryString); ?>"</h2>
        <div class="row">
            <?php if (count($searchResults) > 0) : ?>
                <?php foreach ($searchResults as $product) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-lg">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>" style="height: 180px; background-size: cover; opacity: 0.7;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mt-auto"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($product['price']); ?> €</p>
                                <?php if ($product['is_sold']): ?>
                                <span class="badge bg-danger">Vendu</span>
                            <?php else: ?>
                                <a href="detailProduit.php?idp=<?php echo htmlspecialchars($product['idp']); ?>" class="btn btn-primary">Voir plus</a>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucun résultat trouvé pour "<?php echo htmlspecialchars($queryString); ?>".</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
