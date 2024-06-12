<?php
// Start a session to manage user state across requests
session_start();

// Include files for HTML structure and database connection
require 'htmlbasics.php'; // Ensure this path is correct
require 'connexion.php'; // Ensure this path is correct

// Check if the category ID is set in the query parameters
if (isset($_GET['idc'])) {
    $idc = mysqli_real_escape_string($connexion, $_GET['idc']);
    $userId = isset($_SESSION['user_id']) ? mysqli_real_escape_string($connexion, $_SESSION['user_id']) : null;

    // SQL query to retrieve the category name
    $catQuery = "SELECT nom FROM categorie WHERE id = '$idc' LIMIT 1";
    $catResult = mysqli_query($connexion, $catQuery);
    // Check if the category was found
    if ($catResult && mysqli_num_rows($catResult) > 0) {
        $catName = mysqli_fetch_assoc($catResult)['nom'];
    } else {
        echo "Catégorie non trouvée.";
        exit;
    }

    // SQL query to fetch all products in the category excluding user's own products
    $query = "SELECT * FROM product WHERE idc = '$idc' AND idu != '$userId'";
    $result = mysqli_query($connexion, $query);
    $annonces = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Aucune catégorie spécifiée.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces de la catégorie - <?php echo htmlspecialchars($catName); ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body data-bs-theme="dark">
    <style>
        .card {
            overflow: hidden;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            background-color: #343a40;
            color: #ffffff;
        }
    </style>

    <?php
    // Include different headers based on user session status
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        include 'scripts/headerc.php'; // Header for logged-in users
    } else {
        include 'scripts/headernc.php'; // Header for non-logged-in users
    }
    ?>

    <div class="container py-5">
        <h2 class="pb-2 border-bottom">Annonces de la catégorie - <?php echo htmlspecialchars($catName); ?></h2>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($annonces as $annonce) : ?>
                <div class="col">
                    <div class="card h-100 shadow-lg">
                        <img src="<?php echo htmlspecialchars($annonce['Image']); ?>" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                        <div class="card-body bg-dark text-white">
                            <h5 class="card-title"><?php echo htmlspecialchars($annonce['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($annonce['price']); ?> €</p>
                            <?php if ($annonce['is_sold']): ?>
                                <span class="badge bg-danger">Vendu</span>
                            <?php else: ?>
                                <a href="detailProduit.php?idp=<?php echo htmlspecialchars($annonce['idp']); ?>" class="btn btn-primary">Voir plus</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
