<?
require 'init.php';

displayFlash();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

    if (isset($_POST['itemID'])) {
        if (isset($_SESSION['cart'][$_POST['itemID']])) {
            $value = $_SESSION['cart'][$_POST['itemID']];
            $_SESSION['cart'][$_POST['itemID']] = $value+1;
        } else {
            $_SESSION['cart'][$_POST['itemID']] = 1;
        }
    }

    header("Location: koszyk.php");