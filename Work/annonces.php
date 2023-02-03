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
    <link rel="stylesheet"  href="CSS/styleannonces.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['user_name'])){
            include 'scripts/headernc.php';
        }else{
            include 'scripts/headerc.php';
        }
    $res1 = [];
?>
                                                                    <!-- Search bar body -->
    <h2 class="centeredtitle"> Voici les annonce que vous avez publie.</h2>
    <div class="cent" style="margin-right: 10%; margin-left: 10%;">
        <div class="container">
            <div class="recherche-text">
                <h1>Rechercher dans vos annonces</h1>
                    <div class="rechrectangle">
                        <form action="" method="post">
                        <div class='rectangle'>
                            <p><input type="text" name="recherche" placeholder="..." style="height: 29px;"></p>
                            <?php
                                if (isset($_POST['bout'])){
                                    $recherche = $_POST['recherche'];
                                    $req1 = "select image, name, description, price, nom from product, categories where name like '%" . $recherche . "%' and idu = " . $_SESSION['user_id'] ."
                                             and categories.id = product.idc";  
                                    $res1 = mysqli_query($connexion, $req1);
                                }
                            ?>
                        </div>
                        <div class='elbouton'>
                            <p><input type="submit" value="Rechercher" name="bout" class="searchbutton"></p>
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
                                                                    <!-- End searchbar body -->

<br>
<?php 
    if(isset($_POST['bout'])){
        foreach ($res1 as $req2tab) {
            echo "
                <div class='Prods'>
                    <a class='pistache' href='#'>
                    <div class='prodstuff'>
                            <img class='imghp prodpic' src='images/" . $req2tab["image"] . "'>
                        <div class='jeez'>
                            <div>
                                <p class='prodname spacex' style='color: #4183d7 ;'>" . $req2tab["name"] . "</p>
                            </div>
                            <div>
                                <p class = 'prodprice spacex' style='font-weight:600'>" . $req2tab["price"] . " € </p>
                            </div>
                            <div>
                            <p class = 'prodesc'>" . $req2tab["description"] . "</p>
                            </div>
                            <div>
                                <p class='prodesc'>" . $req2tab["nom"] . "</p>
                             </div>
                        </div>
                    </a>
                    </div>
                <br>
                </div>
                </a>
                ";
        }
    } else{ 
        echo "Vous n'avez aucune annonce";
        }
    
?>
</body>
</html>
