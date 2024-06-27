<?php

session_start();
$id = $_GET['id'];

$_SESSION['products'][$id]['count']--;

if($_SESSION['products'][$id]['count']<=0){
    unset($_SESSION['products'][$id]);
}
echo "<script>location='cart.php'</script>";
?>