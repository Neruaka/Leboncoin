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
    <link rel="stylesheet"  href="CSS/stylehp.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['user_name'])){
            include 'scripts/headernc.php';
        }else{
            include 'scripts/headerc.php';
        }
    $res1 = [];
    $res2 = [];
?>
                                                                    <!-- Search bar body -->
    <h2 class="centeredtitle"> Voici les annonces concernant les véhicules.</h2>
         <?php
             $req1 = "select image, name, description, price from product where idc = 1";  
             $res1 = mysqli_query($connexion, $req1);
         ?>
<br>
<?php  
    foreach ($res1 as $req2tab) {
        echo "
            <div class='Prods'>
                <a class='pistache' href='#'>
                <p class='prodname'>" . $req2tab["name"] . "</p>
                <div class='prodstuff'>
                    <div class = 'prodpic'>
                        <img class='imghp' src='images/" . $req2tab["image"] . "'>
                    </div>
                        <p class = 'prodesc'>" . $req2tab["description"] . "</p>
                        <p class = 'prodprice'>" . $req2tab["price"] . " € </p>
                </div>
                </a>
            </div>
            <br>";
    }
?>
</body>
</html>
