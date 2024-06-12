<?php
session_start();
require 'htmlbasics.php';
require 'connexion.php';

if (isset($_GET['idp'])) {
    $idp = mysqli_real_escape_string($connexion, $_GET['idp']);

    $query = "SELECT * FROM product WHERE idp = '$idp' LIMIT 1";
    $result = mysqli_query($connexion, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $produit = mysqli_fetch_assoc($result);
        $userId = $produit['idu']; // Récupère l'ID de l'utilisateur/vendeur pour ce produit
    } else {
        echo "Produit non trouvé.";
        exit;
    }

    // Requête pour récupérer d'autres annonces du même vendeur
    $otherProductsQuery = "SELECT * FROM product WHERE idu = '$userId' AND idp != '$idp'";
    $otherProductsResult = mysqli_query($connexion, $otherProductsQuery);
    $otherProducts = mysqli_fetch_all($otherProductsResult, MYSQLI_ASSOC);
} else {
    echo "Aucun identifiant de produit fourni.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détails du produit</title>
</head>

<body data-bs-theme="dark">
    <?php
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        include 'scripts/headerc.php';
    } else {
        include 'scripts/headernc.php';
    }
    ?>
    <div class="container py-5">
    <!-- Détails du produit -->
    <div class="row">
        <div class="col-md-6">
            <!-- Image principale du produit dans une card avec taille fixe -->
            <div class="card">
                <img src="<?php echo htmlspecialchars($produit['Image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produit['name']); ?>" style="height: 400px; object-fit: cover;">
            </div>
        </div>
        <div class="col-md-6">
            <h1><?php echo htmlspecialchars($produit['name']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($produit['description'])); ?></p>
            <h3>Prix: <span class="text-success"><?php echo htmlspecialchars($produit['price']); ?> €</span></h3>
            <?php if (isset($produit['idu'])): ?>
                <a href="startChat.php?receiver_id=<?php echo htmlspecialchars($produit['idu']); ?>&product_id=<?php echo htmlspecialchars($produit['idp']); ?>" class="btn btn-primary">Contacter le vendeur</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Autres annonces du vendeur -->
    <h4 class="mt-5">Autres annonces du vendeur</h4>
    <div class="row">
        <?php foreach ($otherProducts as $product) : ?>
            <div class="col-md-3 mb-3">
                <div class="card h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('<?php echo htmlspecialchars($product['Image']); ?>'); background-size: cover;">
                    <div class="overlay" style="background: rgba(0, 0, 0, 0.5); position: absolute; top: 0; bottom: 0; left: 0; right: 0;"></div>
                    <div class="card-body position-relative p-4">
                        <h5 class="card-title text-white"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text text-white"><?php echo htmlspecialchars($product['price']); ?> €</p>
                        <a href="detailProduit.php?idp=<?php echo htmlspecialchars($product['idp']); ?>" class="btn btn-primary">Voir plus</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</body>

</html>