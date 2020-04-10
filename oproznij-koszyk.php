<?php
require 'init.php';

displayFlash();

$_SESSION['flash'] = "Koszyk został opróżniony!";
$_SESSION['cart'] = [];
header("Location: index.php");
?>
