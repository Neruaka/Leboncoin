<?php
session_start();
require 'htmlbasics.php'; // Assurez-vous que ce chemin est correct
require 'connexion.php'; // Assurez-vous que ce chemin est correct

if (isset($_GET['idc'])) {
    $idc = mysqli_real_escape_string($connexion, $_GET['idc']);
     // Requête pour récupérer le nom de la catégorie
     $catQuery = "SELECT nom FROM categorie WHERE id = '$idc' LIMIT 1";
     $catResult = mysqli_query($connexion, $catQuery);
     if ($catResult && mysqli_num_rows($catResult) > 0) {
         $catName = mysqli_fetch_assoc($catResult)['nom'];
     } else {
         echo "Catégorie non trouvée.";
         exit;
     }

    $query = "SELECT * FROM product WHERE idc = '$idc'";
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
</head>
<body data-bs-theme="dark">
<?php
if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){
    include 'scripts/headerc.php'; 
  }else{
    include 'scripts/headernc.php';
  }
?>
<div class="container py-5">
<h2 class="pb-2 border-bottom">Annonces de la catégorie - <?php echo htmlspecialchars($catName); ?></h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($annonces as $annonce): ?>
        <div class="col">
            <div class="card h-100 card-cover text-bg-dark rounded-5 shadow-lg" >
                <div class="d-flex flex-column h-100 p-4 pb-3 text-shadow-1">
                <div class="card">
                <img src="<?php echo htmlspecialchars($annonce['Image']); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($annonce['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($annonce['price']); ?> €</p>
                    <a href="detailProduit.php?idp=<?php echo htmlspecialchars($annonce['idp']); ?>" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
