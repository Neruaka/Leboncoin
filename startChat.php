<?php
session_start();
require 'htmlbasics.php';
require 'connexion.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexionhp.php');
    exit();
}

$receiver_id = isset($_GET['receiver_id']) ? intval($_GET['receiver_id']) : null;
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;  // Récupérer l'ID du produit

if (!$receiver_id || !$product_id) {
    die("Erreur : L'ID du destinataire ou du produit est manquant.");
}

// Vérifiez si le chat est clôturé
$checkClosedQuery = "SELECT is_closed FROM messages WHERE product_id = $product_id LIMIT 1";
$checkClosedResult = mysqli_query($connexion, $checkClosedQuery);
$isClosed = mysqli_fetch_assoc($checkClosedResult)['is_closed'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['message']) && !$isClosed) {
    $message_text = mysqli_real_escape_string($connexion, $_POST['message']);
    $query = "INSERT INTO messages (sender_id, receiver_id, message_text, product_id, timestamp) VALUES (" . $_SESSION['user_id'] . ", $receiver_id, '$message_text', $product_id, NOW())";
    mysqli_query($connexion, $query);
    // Redirection pour éviter la re-soumission du formulaire
    header("Location: startChat.php?receiver_id=$receiver_id&product_id=$product_id");
    exit();
}

$query = "SELECT m.message_text, m.timestamp, m.sender_id FROM messages m WHERE m.product_id = $product_id AND ((sender_id = " . $_SESSION['user_id'] . " AND receiver_id = $receiver_id) OR (sender_id = $receiver_id AND receiver_id = " . $_SESSION['user_id'] . ")) ORDER BY m.timestamp ASC";
$result = mysqli_query($connexion, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Chat</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-box {
            height: 400px;
            overflow-y: auto;
            background-color: #343a40;
            border: 1px solid #dee2e6;
            padding: 10px;
            color: #f8f9fa;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .my-message {
            background-color: #007bff;
            color: white;
            text-align: right;
            margin-left: 50%;
            border-bottom-right-radius: 0;
        }

        .their-message {
            background-color: #6c757d;
            text-align: left;
            margin-right: 50%;
            border-bottom-left-radius: 0;
        }
    </style>
</head>
<body data-bs-theme="dark">
    <?php 
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        include 'scripts/headerc.php';
    } else {
        include 'scripts/headernc.php';
    }
    ?>

    <div class="container mt-5">
        <div class="chat-box">
            <?php foreach ($messages as $message): ?>
            <div class="message <?php echo $message['sender_id'] == $_SESSION['user_id'] ? 'my-message' : 'their-message'; ?>">
                <p><?php echo htmlspecialchars($message['message_text']); ?></p>
                <small><?php echo date('H:i', strtotime($message['timestamp'])); ?></small>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (!$isClosed): ?>
            <form method="post" class="mt-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Écrivez votre message ici..." name="message" required>
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-info mt-4">Ce chat est clôturé car le produit a été vendu.</div>
        <?php endif; ?>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
