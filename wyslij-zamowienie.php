<?php
require 'init.php';

displayFlash();

if (isset($_POST)) {

    $lock = 'LOCK TABLES PRODUCTS WRITE';
    $lockQuery = $pdo->query($lock);

    $marks = [];
    for($i = 0; $i < count($_SESSION['cart']); $i++) {
        $marks[] = '?';
    }

    $sql = $pdo->prepare(sprintf('SELECT * FROM PRODUCTS WHERE ID in (%s)', implode(', ', $marks)));
    $sql->execute(array_keys($_SESSION['cart']));

    $products = $sql->fetchAll();

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
        $update = $pdo->prepare('UPDATE PRODUCTS SET AMOUNT=AMOUNT-? WHERE ID=?');
        $update->bindParam(1,$_SESSION['cart'][$product->ID]);
        $update->bindParam(2,$product->ID);
        $update->execute();
        // var_dump($update);
    }
    // die;

    $unlock = 'UNLOCK TABLES';
    $unlockQuery = $pdo->query($unlock);

    $_SESSION['flash'] = "Zamówienie zostało złożone pomyślnie!";

    $_SESSION['cart'] = [];

    header("Location: index.php");
}