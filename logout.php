<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["nome"]);
unset($_SESSION["email"]);
unset($_SESSION["shopping_cart"]);
header("Location:index.php");
?>