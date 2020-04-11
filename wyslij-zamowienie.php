<?php
require 'init.php';

displayFlash();

if (isset($_POST)) {

    $lock = 'LOCK TABLES PRODUCTS WRITE';
    $lockQuery = $pdo->query($lock);


    $sql = $pdo->prepare(sprintf('SELECT * FROM PRODUCTS WHERE ID in (%s)', createImplodedMarksArray(count($_SESSION['cart']))));
    $sql->execute(array_keys($_SESSION['cart']));

    $products = $sql->fetchAll();

    $updateIDamount = [];
    $updateID = [];


    foreach ($products as $product) {
        if ($_SESSION['cart'][$product->ID] > $product->AMOUNT) {
            $_SESSION['flash'] = "Jeden albo więcej z produktów został wyprzedany!";
            $unlock = 'UNLOCK TABLES';
            $unlockQuery = $pdo->query($unlock);
            header('Location: oproznij-koszyk.php');
            die;
        }

        array_push($updateIDamount,$product->ID,$product->AMOUNT-$_SESSION['cart'][$product->ID]);
        array_push($updateID,$product->ID);
    }


    $update = $pdo->prepare(createUpdateQuery(count($_SESSION['cart'])));
    $update->execute(array_merge($updateIDamount,$updateID));


    $unlock = 'UNLOCK TABLES';
    $unlockQuery = $pdo->query($unlock);

    $_SESSION['flash'] = "Zamówienie zostało złożone pomyślnie!";

    $_SESSION['cart'] = [];

    header("Location: index.php");
}
