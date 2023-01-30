<?php 
include 'connexion.php';
// Demmare une session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../CSS/styleRegister.css">
</head>

<body>



    <?php 
          var_dump($_POST);//affichage des infos du formulaire
          var_dump($_FILES);
// "isset" vérifie si le champ "submit" du formulaire a été envoyé. 
if(isset($_POST['submit'])){
// prise des infos du formulaire et les met dans des variables
        $productname = mysqli_real_escape_string($connexion, $_POST['productname']);
        $productdesc = mysqli_real_escape_string($connexion, $_POST['productdesc']);
        $productstate = mysqli_real_escape_string($connexion, $_POST['productstate']);
        $productprice = mysqli_real_escape_string($connexion, $_POST['productprice']);

        // prise de limage 
        $pos = strpos($_FILES["picture"]["name"], ".");
        $ext = substr($_FILES["picture"]["name"], $pos);
        move_uploaded_file($_FILES["picture"]["tmp_name"], "images/".$productname.$ext);
        $imageprod = $productname.$ext;

        // prise du user id 
        $iduser= $_SESSION['user_name'];
        $requserid = "select id from users where username = '$iduser'";
        $iduquery = mysqli_query($connexion, $requserid);
        $rowidu = mysqli_fetch_assoc($iduquery);
        $test1 = $rowidu['id'];

        // prise etat du produit
        $reqstateid = "select id from state where nom = '$productstate'";
        $idsquery = mysqli_query($connexion, $reqstateid);
        $rowidp = mysqli_fetch_assoc($idsquery);
        $test2 = $rowidp['id'];

    

        // ajout du produit
       $req = "INSERT INTO product (idp, idu, name, description, price, ids, Image) 
       VALUES(NULL,'$test1' , '$productdesc', '$productstate', '$productprice', '$test2','$imageprod')";
        mysqli_query($connexion, $req);
        $message[] = "Le produit a bien ete ajoute";
  
}else {
        $message[] = "Erreur, veuillez reesayer d'ajouter le produit.";
}

  // si la variable existe ca met ce bout de code (elle est cree plus haut )
  if(isset($message)){
    // pour chaque message ca nous affiche son contenu
    foreach($message as $message){
        echo '
    <div class="message">
      <span>'.$message.'</span>
    /* symbole de croix pour la fermeture */
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
}
}
?>

 <!-- formulaire d'ajout' -->
 <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">

            <h3>Ajout produit</h3>
            <input type="text" name="productname" placeholder="Entrer nom Produit" required class="box">
            
            <p>Ajouter image du produit</p>
            <p><input type="file" name="picture"></p>
            
            <input type="text" name="productdesc" placeholder="Entrer la description du produit" required class="box">
            
            <input type="number" name="productprice" placeholder="Entrer le prix du produit" required class="box">
            
            <p>
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
            <input type="submit" name="submit" value="ajouter" class="btn">
        </form>
            
    </div>

   
</body>

</html>