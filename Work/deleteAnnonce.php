<?php
session_start();
require 'connexion.php'; // Assurez-vous que ce chemin est correct

if (isset($_GET['idp'])) {
    $idp = mysqli_real_escape_string($connexion, $_GET['idp']);

    // Assurez-vous que l'annonce appartient à l'utilisateur connecté avant de supprimer
    $query = "DELETE FROM product WHERE idp = '$idp' AND idu = '".$_SESSION['user_id']."'";
    
    if (mysqli_query($connexion, $query)) {
        echo "Annonce supprimée avec succès.";
        // Redirection vers mesAnnonces.php
        header("Location: mesAnnonces.php");
    } else {
        echo "Erreur lors de la suppression de l'annonce.";
    }
} else {
    echo "Aucune annonce spécifiée pour la suppression.";
}
?>
