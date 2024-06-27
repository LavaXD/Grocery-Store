<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shuai Jiang</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'conn.php';

    session_start();


    $phone = $_GET["phone"];
    $email = $_GET["email"];
    $name = $_GET["name"];
    $address = $_GET["address"];
    $city = $_GET["city"];
    $suburb = $_GET["suburb"];
    $state = $_GET["state"];
    $country = $_GET['country'];

    if (strlen($phone) != 10 || !is_numeric(($phone))) {

        echo "<script>alert('phone number should be 10 digits!')</script><br>";
        echo "<script>location='checkout.php'; </script>";
    }

    if (!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-z]{2,})$/", $email)) {
        echo "<script>alert('email format incorrect!')</script><br>";
        echo "<script>location='checkout.php'; </script>";
    }

    //recheck qty
    //get all products from session, and remove last comma
    if (isset($_SESSION["products"])) {
        $sql = "select * from Products where product_id in (";
        foreach ($_SESSION['products'] as $product) {
            $sql = $sql . $product['product_id'] . ",";
        }

        $sql = rtrim($sql, ',') . ");";

        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $Pname = $row['product_name'];
                $id = $row['product_id'];
                $count = $_SESSION['products'][$id]['count'];
                if ($row['stock_quantity'] < $count) {
                    unset($_SESSION['products'][$id]);
                    echo "<script>alert('The quantity of $count `$Pname` is unavailable right now given insufficient stock!')</script><br>";
                    echo "<script>location='cart.php'; </script>";
                }
            }
        }
    }

    
    ?>

    <div class="thank">
        <span>Thank you for your order,
            <?php echo $name ?>!
        </span>
    </div>
    <div class="box">
        <div class="title">
            <h2>Order successful! A confirmation email will be sent!</h2>
        </div>

        <h2>Order Details</h2>
        <div class="returnCart" style="border-bottom:1px dashed black">
            <div class="list">
                <?php
                $totalQty = 0;
                $totalPrice = 0;
                if (isset($_SESSION["products"]) && count($_SESSION['products']) > 0) {
                    foreach ($_SESSION['products'] as $product) {
                        $totalQty += $product['count'];
                        $totalPrice += $product['price'] * $product['count'];
                        ?>
                        <div class="item">
                            <img src="/images/<?php echo $product['product_id'] ?>.jpg">
                            <div class="info">
                                <div class="name">
                                    <?php echo $product['product_name'] ?>
                                </div>
                                <div class="price">
                                    <?php echo $product['price'] ?>
                                </div>
                            </div>
                            <div class="quantity">
                                <?php echo $product['count'] ?>
                            </div>
                            <div class="returnPrice">
                                $
                                <?php echo $product['price'] * $product['count'] ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <div style="border-bottom:1px dashed black;padding-bottom:30px">
            <h2>Contact Details</h2>
            <table>
                <tbody>
                    <tr>
                        <td>Customer Name: </td>
                        <td>
                            <?php echo $name ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <?php echo $phone ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <?php echo $email ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td>
                            <?php echo $address ?>
                        </td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td>
                            <?php echo $city ?>
                        </td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td>
                            <?php echo $_GET["state"] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td>
                            <?php echo $country ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="display:flex;justify-content:center">
            <a href="unset.php" style="margin-top:30px;font-size:20px;">
                BACK TO HOME PAGE
            </a>
        </div>
        <div style="display:flex;justify-content:center">
            <img src="/images/logo.webp" style="width:300px;height:250px" alt="">
        </div>
    </div>

</body>

</html>