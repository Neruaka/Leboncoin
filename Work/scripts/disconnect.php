<?php
session_start();
echo $_SESSION["user_name"]." va etre déconnecté";
session_destroy();
header("refresh:3;url=login.php");
//header("location:connexion.php");
?>