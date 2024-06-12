<?php
session_start();
require 'connexion.php'; // Assurez-vous que ce fichier contient la connexion à votre base de données MySQL
require 'htmlbasics.php'; // Inclut les éléments de base HTML

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit;
}

// Vérifier si l'ID de l'annonce est fourni
if (!isset($_GET['idp'])) {
    echo "Aucune annonce spécifiée.";
    exit;
}

$idp = mysqli_real_escape_string($connexion, $_GET['idp']);
$userId = $_SESSION['user_id'];

// Récupérer les détails de l'annonce à modifier
$query = "SELECT * FROM product WHERE idp = '$idp' AND idu = '$userId'";
$result = mysqli_query($connexion, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Annonce non trouvée ou vous n'avez pas le droit de modifier cette annonce.";
    exit;
}

$annonce = mysqli_fetch_assoc($result);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($connexion, $_POST['name']);
    $description = mysqli_real_escape_string($connexion, $_POST['description']);
    $price = mysqli_real_escape_string($connexion, $_POST['price']);

    // Gestion de l'image
    $imagePath = $annonce['Image']; // Chemin par défaut est l'image actuelle
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        // Suppression de l'ancienne image si nécessaire
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        // Définition du nouveau chemin de l'image, en remplaçant les espaces par des underscores
        $filename = basename($_FILES['image']['name']);
        $sanitizedFilename = str_replace(' ', '_', $filename); // Remplacer les espaces par des underscores
        $targetDirectory = "images/produits/";
        $imagePath = $targetDirectory . $sanitizedFilename;
        // Déplacement de l'image uploadée vers le dossier 'uploads'
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // L'image a été uploadée et déplacée avec succès
        } else {
            echo "Erreur lors de l'upload de l'image.";
            $imagePath = $annonce['Image']; // Revenir à l'image précédente en cas d'erreur
        }
    }

    // Mise à jour de l'annonce dans la base de données
    $updateQuery = "UPDATE product SET name = '$name', description = '$description', price = '$price', Image = '$imagePath' WHERE idp = '$idp' AND idu = '$userId'";
    if (mysqli_query($connexion, $updateQuery)) {
        echo "Annonce mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'annonce.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Annonce</title>
</head>

<body data-bs-theme="dark">
    <?php
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        include 'scripts/headerc.php';
    } else {
        include 'scripts/headernc.php';
    }
    ?>
    <div class="container">
        <h2>Modifier Annonce</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($annonce['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($annonce['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prix (€)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($annonce['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image du produit</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if ($annonce['Image']) : ?>
                    <img src="<?php echo htmlspecialchars($annonce['Image']); ?>" width="100" height="100" alt="Image du produit">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>

</html>