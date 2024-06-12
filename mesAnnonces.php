<?php
session_start();
require 'connexion.php';
require 'htmlbasics.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour voir cette page.";
    // Optionnel: Redirection vers la page de connexion
    // header('Location: connexion.php');
    exit;
}

$userId = $_SESSION['user_id'];

// Récupérez les annonces de l'utilisateur connecté
$query = "SELECT * FROM product WHERE idu = '" . mysqli_real_escape_string($connexion, $userId) . "'";
$result = mysqli_query($connexion, $query);
$annonces = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes annonces</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
        <h2>Annonces de <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
        <div class="row">
            <?php foreach ($annonces as $annonce) : ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-lg">
                        <img src="<?php echo htmlspecialchars($annonce['Image']); ?>" alt="<?php echo htmlspecialchars($annonce['name']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body bg-dark text-white">
                            <h5 class="card-title"><?php echo htmlspecialchars($annonce['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($annonce['description']); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($annonce['price']); ?> €</p>
                            <?php if ($annonce['is_sold']) : ?>
                                <span class="badge bg-danger">Vendu</span>
                            <?php else : ?>
                                <a href="markAsSold.php?idp=<?php echo htmlspecialchars($annonce['idp']); ?>" class="btn btn-success">Marquer comme vendu</a>
                            <?php endif; ?>
                            <a href="editAnnonce.php?idp=<?php echo htmlspecialchars($annonce['idp']); ?>" class="btn btn-primary">Modifier annonce</a>
                            <button onclick="deleteAnnonce(<?php echo htmlspecialchars($annonce['idp']); ?>)" class="btn btn-danger">Supprimer annonce</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        function deleteAnnonce(idp) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette annonce ?")) {
                window.location.href = "deleteAnnonce.php?idp=" + idp;
            }
        }
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
