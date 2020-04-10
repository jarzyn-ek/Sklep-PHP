<?php
require 'init.php';

displayFlash();

$sql = 'SELECT * FROM PRODUCTS WHERE AMOUNT>0';
$stmt = $pdo->query($sql);
?>

<div class='link'><a href='koszyk.php'>PRZEJDŹ DO KOSZYKA</a></div>
<?php while ($row = $stmt->fetch()) : ?>
    <article>
        <div>
            <?= $row->NAME ?>
        </div>
        <div>
            <?= $row->PRICE  ?>
        </div>
        <div>
            <?= $row->AMOUNT ?>
            <?php if ($row->AMOUNT>0) {
            ?>
        </div><form action="dodaj_do_koszyka.php" method="POST"><input type="submit" value="DODAJ DO KOSZYKA">
                                                    <input name="itemID" type="hidden" value="<?php echo $row->ID; ?>"> </form>
            <?php } ?>
    </article>
<?php endwhile; 