<?php
session_start();
require 'htmlbasics.php';
require 'connexion.php';

$query = "SELECT * FROM state";
$result = mysqli_query($connexion, $query);
$states = mysqli_fetch_all($result, MYSQLI_ASSOC);

$querycat = "SELECT * FROM categorie";
$resultcat = mysqli_query($connexion, $querycat);
$categorie = mysqli_fetch_all($resultcat, MYSQLI_ASSOC);
// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Assurez-vous que l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        echo "Vous devez être connecté pour ajouter un produit.";
        exit; // Arrêter l'exécution du script si l'utilisateur n'est pas connecté
    }

    // Récupération et nettoyage des données du formulaire
    $userId = $_SESSION['user_id']; // Supposons que l'ID de l'utilisateur est stocké dans $_SESSION lors de la connexion
    $name = mysqli_real_escape_string($connexion, $_POST['name']);
    $description = mysqli_real_escape_string($connexion, $_POST['description']);
    $price = mysqli_real_escape_string($connexion, $_POST['price']);
    $category = mysqli_real_escape_string($connexion, $_POST['category']);
    $state = mysqli_real_escape_string($connexion, $_POST['state']);

    // Traitement de l'image
    $targetDirectory = "images/produits";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insertion dans la base de données
    $query = "INSERT INTO product (idu, name, description, price, ids, image, idc) VALUES ('$userId', '$name', '$description', '$price', '$state', '$targetFile', '$category')";

    if (mysqli_query($connexion, $query)) {
        echo "Produit ajouté avec succès.";
        header('refresh:1; url=homepage.php');
    } else {
        echo "Erreur lors de l'ajout du produit : " . mysqli_error($connexion);
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>
<title>Ajouter un produit</title>

<body data-bs-theme="dark">
    <div class="container py-5">
        <h2 class="pb-2 border-bottom text-white">Ajouter un nouveau produit</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-cover overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background: rgba(0,0,0,0.7);">
                    <div class="card-body p-5">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label text-white">Nom du produit:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label text-white">Description:</label>
                                <textarea id="description" name="description" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label text-white">Prix:</label>
                                <input type="number" id="price" name="price" class="form-control" required step="0.01">
                            </div>

                            <div class="mb-3">
    <label for="category" class="form-label text-white">Catégorie:</label>
    <select id="category" name="category" class="form-select" required>
        <?php foreach ($categorie as $cat) : ?>
            <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                <?php echo htmlspecialchars($cat['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3">
    <label for="state" class="form-label text-white">État du produit:</label>
    <select id="state" name="state" class="form-select" required>
        <?php foreach ($states as $state) : ?>
            <option value="<?php echo htmlspecialchars($state['id']); ?>">
                <?php echo htmlspecialchars($state['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

                            <div class="mb-3">
                                <label for="image" class="form-label text-white">Image du produit:</label>
                                <input type="file" id="image" name="image" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <!-- Bouton Ajouter produit -->
                                <input type="submit" name="submit" value="Ajouter produit" class="btn btn-primary me-2">
                                <!-- Bouton Retour -->
                                <a href="homepage.php" class="btn btn-secondary">Retour</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b-example-divider"></div>
</body>

</html>