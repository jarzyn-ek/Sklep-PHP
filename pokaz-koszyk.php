<?php
    require 'init.php';
    getHeader("SKLEP - TWÓJ KOSZYK");

    displayFlash();
    
    if (!empty($_SESSION['cart'])) {

        $sql = $pdo->prepare(sprintf('SELECT * FROM PRODUCTS WHERE ID in (%s)', createImplodedMarksArray(count($_SESSION['cart']))));
        $sql->execute(array_keys($_SESSION['cart']));
        $array_of_items_in_cart = $sql->fetchAll();

        ?>
<div class="container">
        <?php
        foreach ($array_of_items_in_cart as $item) {
            ?>
            <article>
                <div> 
                <?= $item->NAME ?>
                <?php
                if ($item->AMOUNT < $_SESSION['cart'][$item->ID]) {
                    echo "Nie możesz kupić takiej ilości produktu!<br>";
                }
                ?>
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
            <input type="submit" name="orderSent" value="WYŚLIJ ZAMÓWIENIE">
        </form>
        <form action="oproznij-koszyk.php" method="POST">
            <input type="submit" name="makeCartEmpty" value="OPRÓŻNIJ KOSZYK">
        </form>
    </footer>
</div>
<?php
require 'footer.php';
