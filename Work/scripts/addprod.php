<?php 
// session_start();
    // test pour voir si les donnees sont bien prises en compte
        //   var_dump($_POST);//affichage des infos du formulaire
        //   var_dump($_FILES);
// "isset" vérifie si le champ "submit" du formulaire a été envoyé. 
if(isset($_POST['submit'])){
// prise des infos du formulaire et les met dans des variables
        $productname = mysqli_real_escape_string($connexion, $_POST['productname']);
        $productdesc = mysqli_real_escape_string($connexion, $_POST['productdesc']);
        $productstate = mysqli_real_escape_string($connexion, $_POST['productstate']);
        $productprice = mysqli_real_escape_string($connexion, $_POST['productprice']);
        $productcate = mysqli_real_escape_string($connexion, $_POST['productcate']);
        $message = [];

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

        // prise categorie du produit
        $reqcate = "select id from categories where nom = '$productcate'";
        $catequery = mysqli_query($connexion, $reqcate);
        $rowcate = mysqli_fetch_assoc($catequery);
        $test3 = $rowcate['id'];

        // ajout du produit
       $req = "INSERT INTO product (idp, idu, name, description,ids , price, Image, idc) 
              VALUES(NULL,'$test1', '$productname', '$productdesc', '$test2', '$productprice','$imageprod', '$test3')";
        mysqli_query($connexion, $req);
        $message[] = "Successfully added";
  
}
  // si la variable existe ca met ce bout de code (elle est cree plus haut )
  if(isset($message)){
    // pour chaque message ca nous affiche son contenu
    foreach($message as $message){
        echo '
    <div class="message">
      <span>'.$message.'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
}
}
?>