<?php 
session_start();

if (isset ($_SESSION['products'])) {
    unset($_SESSION['products']);
}

echo "<script>location='cart.php'</script>";
