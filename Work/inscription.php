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
    // connexion bdd
    include 'connexion.php';

    if(isset($_POST['submit'])) {
        // prise des infos du formulaire et les met dans des variables
        $name = mysqli_real_escape_string($connexion, $_POST['name']);
        $mail = mysqli_real_escape_string($connexion, $_POST['email']);
        $password = mysqli_real_escape_string($connexion, $_POST['password']);
        $cpassword = mysqli_real_escape_string($connexion, $_POST['cpassword']);
        // Creation d'une var utilisateur qui affiche tt les utilisateur qui ont ce mdp et ce mail grace a une requete
        $userlist = mysqli_query ($connexion, "SELECT * FROM `users` WHERE mail = '$mail' AND password = '$password'");
        // Si la requete renvoie un utilisateur deja existant ( via mail et mdp ) ca renvoie un message d"erreur
        if(mysqli_num_rows($userlist) != 0){  // ca prend le nombre de lignes de la requetes et si il est different de 0 c'est que il y q dejq un utilisqtuer avec ces parametres 
            $message[] = "L'utilisateur existe déjà!";
         }else{
            /* Si le mot de passe de confirmation (cpass) est pas le meme, ca retourne ce message */
              if($password != $cpassword){
                 $message[] = 'Mot de passe de confirmation incorrecte !';
              }else{
                /* Sinon ca nous confirme que l'utilisateur a bien été ajouté */
                 mysqli_query($connexion,$req);
                 $message[] = 'Compte créer avec succès, veuillez patienter vous allez être redirigé(e) vers la page de connexion...';
                 header('refresh:5; url=login.php');
              }
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
<!-- Formulaire pour l'inscription -->
    <div class="form-container">
    <form action="" method="post">
      <h3>Inscription</h3>
      <input type="text" name="name" placeholder="Entrer votre nom d'utilisateur" required class="box">
      <input type="email" name="email" placeholder="Entrer votre mail" required class="box">
      <input type="password" name="password" placeholder="Entrer votre mdp" required class="box">
      <input type="password" name="cpassword" placeholder="Confirmez votre mdp" required class="box">
      <input type="submit" name="submit" value="S'inscrire" class="btn">
      <p>Vous avez déjà un compte <a href="login.php">Connexion</a></p>
   </form>

    </div>
</body>
</html>