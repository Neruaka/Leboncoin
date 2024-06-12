<?php
session_start();
require 'connexion.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour effectuer cette action.";
    exit;
}

// Récupérez l'ID du produit depuis l'URL
$idp = isset($_GET['idp']) ? intval($_GET['idp']) : null;

if ($idp) {
    // Mettez à jour le statut du produit pour le marquer comme vendu
    $query = "UPDATE product SET is_sold = 1 WHERE idp = $idp AND idu = " . $_SESSION['user_id'];
    if (mysqli_query($connexion, $query)) {
        // Marquez les chats associés comme clôturés
        $closeChatsQuery = "UPDATE messages SET is_closed = 1 WHERE product_id = $idp";
        mysqli_query($connexion, $closeChatsQuery);

        echo "Le produit a été marqué comme vendu et les chats associés ont été clôturés.";
    } else {
        echo "Erreur lors de la mise à jour du produit : " . mysqli_error($connexion);
    }
} else {
    echo "Aucun produit spécifié.";
}

// Redirection vers la page des annonces de l'utilisateur
header('Location: mesAnnonces.php');
exit;
?>
