<?php 
include 'connexion.php';
// Demmare une session
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/styleaddproduct.css">
</head>
<body>
    <?php
        include('scripts/addprod.php');
    ?>
 <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Ajout produit</h3>
            <input type="text" name="productname" placeholder="Entrer nom Produit" required class="box">
                <p>Veuillez indiquer la categorie du produit</p>
            <select name="productcate" class ="box" required>
                <?php
                    $req = "select distinct nom from categories order by id";
                    $res = mysqli_query($connexion, $req);
                    while($ligne = mysqli_fetch_assoc($res)){ ?>
                        <option value="<?=$ligne["nom"]?>"><?=$ligne["nom"]?></option>
                    <?php 
                    }
                ?>
            </select>
            <p>Ajouter image du produit</p>
            <p>
                <input type="file" name="picture">
            </p>
            <input type="text" name="productdesc" placeholder="Entrer la description du produit" required class="box">
            <input type="number" name="productprice" placeholder="Entrer le prix du produit" required class="box">
            <p>
                <p>Veuillez indiquer l'etat du produit</p>
            <select name="productstate" class ="box" required>
                <?php
                    $req = "select distinct nom from state order by id";
                    $res = mysqli_query($connexion, $req);
                    while($ligne = mysqli_fetch_assoc($res)){ ?>
                        <option value="<?=$ligne["nom"]?>"><?=$ligne["nom"]?></option>
                    <?php 
                    }
                ?>
                </select>
            </p>
            <button type="submit" name="submit" class="btn">ajouter</button>
            <button type="button" onclick="hrefFunction()" class='btn'>Retour</button>
        </form>
    </div>
    <script>
        function hrefFunction(){
            window.location.href = "homepage.php";
            }
    </script>
</body>
</html>