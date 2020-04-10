<?php
    require 'init.php';
    displayFlash();
    
    if (!empty($_SESSION['cart'])) {

        $sql = 'SELECT * FROM PRODUCTS WHERE ID in (' . implodeArrayKeys($_SESSION['cart']) . ')';
        $stmt = $pdo->query($sql);
        $array_of_items_in_cart = $stmt->fetchAll();

        ?>
<div class="container">
        <?php
        foreach ($array_of_items_in_cart as $item) {
            ?>
            <article>
                <div>
                <?= $item->NAME ?>
                </div>
                <div>
                <?= $_SESSION['cart'][$item->ID] ?>
                </div>
            </article>
        
        <?php
        }
    }
    ?>
    <footer>
        <form action="wyslij-zamowienie.php" method="POST">
            <input type="submit" value="WYŚLIJ ZAMÓWIENIE">
        </form>
        <form action="oproznij-koszyk.php" method="POST">
            <input type="submit" value="OPRÓŻNIJ KOSZYK">
        </form>
    </footer>
</div>
