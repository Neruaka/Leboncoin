<?php
include 'scripts/connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page d'acceuil</title>
  <link rel="stylesheet" href="CSS/styleheader.css">
</head>
<body>
  <header class="header">
    <!--        Nav bar         -->
    <nav id="navbar" class="nav">
      <div display="flex" class="pgm">
        <a href="homepage.php"> <img src="images/logo.png" alt="Logo" class="logo"></a>
        <a href="addproduct.php" class="btn_annonce">
          <img src="images/pluss.png" alt="btn_plus" class="top_plus_btn" style="margin-right: 6px;">Deposer une annonce
        </a>
        <form action="" method="post" class="search-container">
          <img src="images/loupe.png" alt="btn_plus" class="top_plus_btn" style="margin-right: 6px;">
          <input type="text" id="search-bar" placeholder="Rechercher">
        </form>
      </div>
      <div display="flex" class="connexion">
        <a href="fav.php" class="top_right">
          <img src="images/msg.png" alt="msg_img" class="top_plus_btn">Messages</a>
        <a href="msg.php" class="top_right">
          <img src="images/fav.png" alt="fav_img" class="top_plus_btn">Favoris</a>
        <a href="account.php" class="top_right">
          <img src="images/connect.png" alt="Connexion_img" class="top_plus_btn">
          <?php 
            echo $_SESSION['user_name'];
          ?>
        </a>
      </div>
      <div class="ducros">
        <ul class="categories">
          <li>
          <a href="homepageVehicules.php">Véhicules</a>
          </li>
          <li>
            <a href="homepageMode.php">Mode</a>
          </li>
          <li>
            <a href="homepageMultimedia.php">Multimedia</a>
          </li>
          <li>
            <a href="homepageAutres.php">Autres</a>
          </li>
        </ul>
      </div>
    </nav>
    <!--        Fin Navbar        -->
  </header>
</body>
</html>