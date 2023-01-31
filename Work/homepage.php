<?php
include 'connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasleboncoin</title>
    <link rel="stylesheet" href="css/stylehp.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['user_name'])){
            include 'headerc.php';
        }else{
            include 'headernc.php';
        }
    $res1 = [];
    $res2 = [];
?>
                                                                    <!-- Search bar body -->
    <h2 class="centeredtitle"> Il n'y a aucune annonce sur ce site mais vous pouvez quand meme faire une recherche.</h2>
    <div class="cent">
        <div class="container">
            <div class="recherche-text">
                <h1>Faites votre recherche.</h1>
                    <div class="arr">
                        <form action="" method="post">
                        <div class="div-search-cat">
                            <label class="search-cat">Catégorie</label>
                            <select class="formcat" name="formcat">
                                <?php
                                    $req = "select id, nom from categories order by id";
                                    $res = mysqli_query($connexion, $req);
                                    // die(var_dump(mysqli_fetch_assoc($res)));
                                    while($ligne = mysqli_fetch_assoc($res)){ ?>
                                            <option value="<?=$ligne["id"]?>"><?=$ligne["nom"]?></option>
                                            <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <p><input type="text" name="recherche" placeholder="Que ne recherchez-vous pas :"></p>
                            <?php
                                if (isset($_POST['bout'])){
                                    $recherche = $_POST['recherche'];
                                    $req1 = "select image, name, description, price from product where name like '%" . $recherche . "%' and idc = " . $_POST['formcat'];  
                                    $res1 = mysqli_query($connexion, $req1);
                                    $req2 = "select image, name, description, price from product";  
                                    $res2 = mysqli_query($connexion, $req2);
                                }
                            ?>
                        <p><input type="submit" value="Rechercher" name="bout"></p>
                    </form>


                </div>
                </div>
        </div>
    </div>
                                                                    <!-- End searchbar body -->

<br>
<?php 
    if(!isset($res1)){
        foreach ($res2 as $papayo) {
            echo "
                <div class='totota'>
                    <img src='images/" . $papayo["image"] . "'>
                    <p>" . $papayo["name"] . "</p>
                    <p>" . $papayo["description"] . "</p>
                </div>";
        }
    } else{ 
        foreach($res1 as $papaya){
            echo "
                <div class='totota'>
                    <img src='images/".$papaya["image"]."'>
                    <p>".$papaya["name"]. "</p>
                    <p>".$papaya["description"]. "</p>
                </div>";
        }
    }
?>
</body>
</html>