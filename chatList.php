<?php
session_start();
require 'htmlbasics.php';
require 'connexion.php';

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexionhp.php');
    exit;
}

// Récupération des chats de l'utilisateur avec les IDs nécessaires pour le chat
$query = "
SELECT p.idp, p.name, p.Image, m.is_read, MAX(m.timestamp) AS last_message_time,
       CASE WHEN m.sender_id = ".$_SESSION['user_id']." THEN m.receiver_id ELSE m.sender_id END AS other_user_id
FROM messages m
JOIN product p ON m.product_id = p.idp
WHERE m.sender_id = ".$_SESSION['user_id']." OR m.receiver_id = ".$_SESSION['user_id']."
GROUP BY p.idp
ORDER BY last_message_time DESC";

$result = mysqli_query($connexion, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chats Overview</title>
    <link rel="stylesheet" href="path_to_css/bootstrap.min.css">
    <style>
        .card {
            background-size: cover;
            color: white;
        }
        .unread {
            font-weight: bold;
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

    <div class="container py-5">
        <h2>Vos Conversations</h2>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="background-image: url('<?= htmlspecialchars($row['Image']) ?>');">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text <?= $row['is_read'] ? '' : 'unread' ?>">
                                <?= $row['is_read'] ? 'Lu' : 'Non lu' ?>
                            </p>
                            <p class="card-text">Dernier message: <?= $row['last_message_time'] ?></p>
                            <a href="startChat.php?receiver_id=<?= $row['other_user_id'] ?>&product_id=<?= $row['idp'] ?>" class="btn btn-primary">Chat</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>


    <script src="path_to_js/bootstrap.bundle.min.js"></script>
</body>
</html>
