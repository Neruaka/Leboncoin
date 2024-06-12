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
    <h2 class="centeredtitle"> Il n'y a aucune annonce sur ce site mais vous pouvez quand meme faire une recherche.</h2>
    <div class="cent" style="margin-right: 10%; margin-left: 10%;">
        <div class="container">
            <div class="recherche-text">
                <h1>Faites votre recherche.</h1>
                    <div class="rechrectangle">
                        <form action="" method="post">
                        <div class="div-search-cat">
                            <label class="search-cat">Catégorie</label>
                            <select class="formcat" name="formcat">
                                <option value=""></option>
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
                        <div class='rectangle'>
                            <p><input type="text" name="recherche" placeholder="Que ne recherchez-vous pas :" style="height: 29px;"></p>
                            <?php
                                if (isset($_POST['bout'])){
                                    $recherche = $_POST['recherche'];
                                    $req1 = "select image, name, description, price from product where name like '%" . $recherche . "%' and idc = " . $_POST['formcat'];  
                                    $res1 = mysqli_query($connexion, $req1);
                                    $req2 = "select image, name, description, price from product";  
                                    $res2 = mysqli_query($connexion, $req2);
                                    $req3 = "select image, name, description, price from product where idc = " . $_POST['formcat'];
                                    $res3 = mysqli_query($connexion, $req3);
                                    $test = '';
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
// si la cate est vide (donc add empty cat) alors ca recherche dans tt  
    if(isset($_POST['bout'])){
        if ($_POST['formcat'] && $_POST['recherche'] != $test ) {
            foreach($res1 as $req1tab){
                echo "
                    <div class='Prods'>
                    <p class='prodname'>" . $req1tab["name"] . "</p>
                    <div class='prodstuff'>
                        <div class = 'prodpic'>
                            <img class='imghp' src='images/" . $req1tab["image"] . "'>
                        </div>
                            <p class = 'prodesc'>" . $req1tab["description"] . "</p>
                            <p class = 'prodprice'>" . $req1tab["price"] . " € </p>
                    </div>
                </div>
                <br>";
            }       
        }
        else{
            foreach ($res2 as $req2tab) {
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
        }
        
    } 
?>
</body>
</html>
