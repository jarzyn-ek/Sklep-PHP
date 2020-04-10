<?php
require 'init.php';

displayFlash();

if (isset($_POST)) {

    $lock = 'LOCK TABLES PRODUCTS WRITE';
    $lockQuery = $pdo->query($lock);
    $sql = 'SELECT * FROM PRODUCTS WHERE ID in (' . implodeArrayKeys($_SESSION['cart']) . ')';
    $stmt = $pdo->query($sql);

    $products = $stmt->fetchAll();

    foreach($products as $product) {
        if ($_SESSION['cart'][$product->ID] > $product->AMOUNT) {
            $_SESSION['flash'] = "Jeden albo więcej z produktów został wyprzedany!";
            $unlock = 'UNLOCK TABLES';
            $unlockQuery = $pdo->query($unlock);
            header('Location: oproznij-koszyk.php');
            die;
        } 
    }

    foreach($products as $product) {
        $update = 'UPDATE PRODUCTS SET AMOUNT=AMOUNT-' . $_SESSION['cart'][$product->ID] .  ' WHERE ID=' . $product->ID;
        $pdo->query($update);
    }

    $unlock = 'UNLOCK TABLES';
    $unlockQuery = $pdo->query($unlock);

    $_SESSION['flash'] = "Zamówienie zostało złożone pomyślnie!";

    $_SESSION['cart'] = [];

    header("Location: index.php");
}