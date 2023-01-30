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

// "isset" vérifie si le champ "submit" du formulaire a été envoyé. 
if(isset($_POST['submit'])){
// prise des infos du formulaire et les met dans des variables
       $email = mysqli_real_escape_string($connexion, $_POST['email']);
       $pass = mysqli_real_escape_string($connexion, $_POST['password']);
       $req = mysqli_query($connexion, "SELECT * FROM `users` WHERE mail = '$email' AND password = '$pass'");
// Si l'utilisateur existe (!=0) alors ca ouvre la variable de session
       if(mysqli_num_rows($req) != 0){
        // récupére les informations de l'utilisateur sous forme d'un tableau associatif
        $row = mysqli_fetch_assoc($req);
        // stocke ces informations dans des variables de session
        $_SESSION['user_name'] = $row['username'];
        $_SESSION['user_email'] = $row['mail'];
        $_SESSION['user_id'] = $row['id'];
        header('refresh:2; url=addproduct.php');

   }else{
      $message[] = 'Email ou mot de passe incorrect';
   
    }
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



<!-- formulaire de connexion -->
<div class="form-container">

<form action="" method="post">
   <h3>Se connecter</h3>
   <input type="email" name="email" placeholder="Mail" required class="box">
   <input type="password" name="password" placeholder="Mot de passe" required class="box">
   <input type="submit" name="submit" value="Connexion" class="btn">
   <p>Vous n'avez pas de compte ? <a href="inscription.php">S'inscrire</a></p>
</form>

</div>
</body>
</html>