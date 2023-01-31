<?php
include 'connexion.php';
session_start();
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
        <img src="images/logo.png" alt="Logo" class="logo">
        <a href="#" class="btn_annonce">
          <img src="images/plus.png" alt="btn_plus" class="top_plus_btn">Deposer une annonce</a>
        <form class="search-container">
          <!-- <input type="image" names="submit" src="../images/loupe.png" class="top_plus_btn" /> -->
          <input type="text" id="search-bar" placeholder="Que desirez-vous ?">
        </form>
      </div>
      <div display="flex" class="connexion">
        <a href="login.php" class="top_right">
          <img src="images/connect.png" alt="Connexion_img" class="top_plus_btn">Se connecter
        </a>
      </div>
      <div class="ducros">
        <ul class="categories">
          <li>
            <a href="#">Véhicules</a>
          </li>
          <li>
            <a href="#">Mode</a>
          </li>
          <li>
            <a href="#">Multimedia</a>
          </li>
          <li>
            <a href="#">Autres</a>
          </li>
        </ul>
      </div>
    </nav>
    <!--        Fin Navbar        -->
  </header>
</body>

</html>