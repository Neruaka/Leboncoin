<?php
session_start();
require 'htmlbasics.php';
require 'connexion.php';

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexionhp.php');
    exit();
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($connexion, $_POST['username']);
    $email = mysqli_real_escape_string($connexion, $_POST['email']);
    $newPassword = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $_SESSION['user_password'];

    $updateQuery = "UPDATE users SET username='$username', mail='$email', password='$newPassword' WHERE id=" . $_SESSION['user_id'];

    if (mysqli_query($connexion, $updateQuery)) {
        $_SESSION['user_name'] = $username;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_password'] = $newPassword;

        if (!empty($_FILES['pp']['name'])) {
            $uniqueId = time() . rand(1000, 9999);
            $pos = strpos($_FILES["pp"]["name"], ".");
            $ext = substr($_FILES["pp"]["name"], $pos);
            $filename = $username . $uniqueId . $ext;
            $filepath = "images/pp/" . $filename;

            if (move_uploaded_file($_FILES["pp"]["tmp_name"], $filepath)) {
                $updatePic = "UPDATE users SET pp='$filename' WHERE id=" . $_SESSION['user_id'];
                if (!mysqli_query($connexion, $updatePic)) {
                    $message .= "Erreur lors de la mise à jour de l'image: " . mysqli_error($connexion);
                }
            } else {
                $message .= " Échec de l'upload de l'image.";
            }
        }
        $message .= " Modifications enregistrées avec succès!";
    } else {
        $message .= " Erreur lors de l'enregistrement des modifications: " . mysqli_error($connexion);
    }
}
?>


<body data-bs-theme="dark">
    <?php
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        include 'scripts/headerc.php';
    } else {
        include 'scripts/headernc.php';
    }
    ?>
    <title>Modifier Profile</title>
    <div class="container mt-5">
        <h2>Paramètres du profil</h2>
        <?php if ($message) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['user_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user_email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="pp" class="form-label">Photo de profil</label>
                <input type="file" class="form-control" id="pp" name="pp">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>