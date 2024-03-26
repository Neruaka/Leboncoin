<?php
// Démarrer la session PHP
session_start();

require 'connexion.php';

// Vérifier si l'ID du vendeur est passé via GET
if (isset($_GET['seller_id']) && !empty($_GET['seller_id'])) {
    $seller_id = $_GET['seller_id'];
    $buyer_id = $_SESSION['user_id']; 

    // Recherchez une session de chat existante entre l'acheteur et le vendeur
    $query = "SELECT id FROM chat_sessions WHERE (user_id1 = '$buyer_id' AND user_id2 = '$seller_id') OR (user_id1 = '$seller_id' AND user_id2 = '$buyer_id')";
    $result = mysqli_query($connexion, $query);

    if (mysqli_num_rows($result) > 0) {
        // Une session de chat existe déjà, récupérer son ID
        $chat_session = mysqli_fetch_assoc($result);
        $chat_session_id = $chat_session['id'];
    } else {
        // Aucune session de chat n'existe, en créer une nouvelle
        $insert_query = "INSERT INTO chat_sessions (user_id1, user_id2) VALUES ('$buyer_id', '$seller_id')";
        if (mysqli_query($conn, $insert_query)) {
            $chat_session_id = mysqli_insert_id($conn);
        } else {
            die("Erreur lors de la création de la session de chat : " . mysqli_error($conn));
        }
    }

    // Rediriger l'utilisateur vers la page de chat avec l'ID de la session de chat
    header("Location: chatInterface.php?session_id=" . $chat_session_id);
    exit;
} else {
    echo "ID du vendeur manquant.";
}
?>
