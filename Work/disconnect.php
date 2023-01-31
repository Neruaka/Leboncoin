<?php
session_start();
echo $_SESSION["pseudo"]." va etre déconnecté";
session_destroy();
header("refresh:3;url=signin.php");
//header("location:connexion.php");
?>