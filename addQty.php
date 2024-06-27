<?php

session_start();
include 'conn.php';

$id = $_GET['id'];
$sql = "select stock_quantity from Products where product_id=$id";
$res = $conn->query($sql);
$stock = $res->fetch_column();

if($_SESSION['products'][$id]['count'] == $stock){
    echo "<script>alert('The entered quantity cannot be greater than stock quantity!');</script>";
    echo "<script>location='cart.php'</script>";
} else {
    $_SESSION['products'][$id]['count']++; 
   echo "<script>location='cart.php'</script>";
}
?>

