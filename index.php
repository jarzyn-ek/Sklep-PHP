<link rel="stylesheet" href="resources/main.css">
<?php
require 'init.php';

$sql = 'SELECT * FROM PRODUCTS';
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
        </div><form action="dodaj_do_koszyka.php" method="POST"><input type="submit" value="DODAJ DO KOSZYKA">
                                                    <input name="itemID" type="hidden" value="<?php echo $row->ID; ?>"> </form>
    </article>
<?php endwhile; ?>