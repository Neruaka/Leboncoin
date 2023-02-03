<?php
include 'scripts/connexion.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasleboncoin</title>
    <link rel="stylesheet"  href="CSS/profile.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['user_name'])){
            include 'scripts/headernc.php';
        }else{
            include 'scripts/headerc.php';
        }
?>
      
                                                                    <!--  -->
    <div class="containerap">
        <div class="Annonces">
            <div class="recherche-text">
                <div class="rechrectangle">
                    <div class="logoann">
                        <img src="images/annonces.png" alt="logoannonces">
                    </div>
                    <div class="textann">
                        <h3>Annonces</h3>
                        <span>Gérer mes annonces déposées</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="Profile">
            <div class="rechrectangle">
                <img src="images\jeremy.png" alt="pp" class="pp">
            </div>
            <div class="profrect">
                <div class="username">
                    <?php 
                        echo $_SESSION['user_name'];
                    ?>
                </div><br>
                <a href="#">editer le profile</a>      
            </div>
        </div>
    </div>
<br>
</body>
</html>
