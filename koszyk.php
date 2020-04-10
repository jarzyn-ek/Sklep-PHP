<?php
    require 'init.php';
    
    if (!empty($_SESSION['cart'])) {
        echo "Twój koszyk ma zawartość!";

        foreach ($_SESSION['cart'] as $key=>$value) {
            $sql = 'SELECT * FROM PRODUCTS WHERE ID=' . $key;
            $stmt = $pdo->query($sql);
            $row = $stmt->fetch();
            ?>
            <article>
                <div>
                    <?= $row->NAME ?>
                </div>
            <div>
            <?= $value  ?>
            </div>
            <?php
        }
    }
