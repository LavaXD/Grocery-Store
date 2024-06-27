<?php

session_start();

include 'conn.php';

// reduce qty in database
if (isset($_SESSION["products"])) {
    foreach ($_SESSION['products'] as $product) {
        $count = $product['count'];
        $id = $product['product_id'];
        $minusQtySql = "update Products set stock_quantity = stock_quantity-$count where product_id =$id";
        $res = $conn->query($minusQtySql);
    }
}

// unset cart in session
if (isset($_SESSION['products'])) {
    unset($_SESSION['products']);
}

echo "<script>location='index.php'</script>";
?>