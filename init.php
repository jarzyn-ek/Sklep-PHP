<link rel="stylesheet" href="resources/main.css">
<?php
session_start();

displayFlash();

$host =  'localhost';
$user = 'root';
//   $password = '123456';
$dbname = 'PAI6';

$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

$pdo = new PDO($dsn, $user);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


function implodeArrayKeys($array) {
    return implode(", ",array_keys($array));
}

function displayFlash() {
    if (isset($_SESSION['flash'])) {
        echo "<p>" . $_SESSION['flash'] . "</p>";
        unset($_SESSION['flash']);
    }
}
