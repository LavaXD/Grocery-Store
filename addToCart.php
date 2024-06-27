<?php
session_start();
include 'conn.php';

$CartProductId = $_GET["cart_product_id"];
$sqlProduct = "select * from Products where product_id=$CartProductId";
$result = $conn->query($sqlProduct);
$rowProduct = $result->fetch_assoc();
$name = $rowProduct["product_name"];

if(isset($_SESSION['products'])){

    //if this product already in 'products', count++
    foreach($_SESSION['products'] as $product){
        if($CartProductId == $product['product_id']){
            $_SESSION['products'][$CartProductId]['count']++;
            echo "<script>location = 'cart.php'</script>";
            exit();
        }
    }
}
//put product into cart
$_SESSION['products'][$CartProductId] = $rowProduct;
$_SESSION['products'][$CartProductId]['count'] = 1;

echo "<script>location='cart.php'</script>";

?>

