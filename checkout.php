<!DOCTYPE html>
<html lang="en">
<?php
include 'conn.php';

session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shuai Jiang</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="checkoutLayout">
            <div class="returnCart">
                <div class="header">
                    <img src="/images/logo.webp" alt="">
                    <a href="/">KEEP SHOPPING</a>
                </div>


                <h1>Products in Cart</h1>
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


            <div class="right">
                <h1>Checkout</h1>

                <form class="form" name="checkOutForm" method="GET" action="orderDetail.php">
                    <div class="group">
                        <label for="name">Full Name *</label>
                        <input type="text" name="name" id="name" required="required">
                    </div>

                    <div class="group">
                        <label for="phone">Phone Number *</label>
                        <input type="text" name="phone" id="phone" required="required">
                    </div>

                    <div class="group">
                        <label for="address">Address *</label>
                        <input type="text" name="address" id="address" required="required">
                    </div>

                    <div class="group">
                        <label for="Email">Email *</label>
                        <input type="text" name="email" id="email" required="required">
                    </div>

                    <div class="group">
                        <label for="State">State *</label>
                        <select name="state"  required="required">
                            <option value="">Choose..</option>
                            <option value="NSW">NSW</option>
                            <option value="VIC">VIC</option>
                            <option value="QLD">QLD</option>
                            <option value="WA">WA</option>
                            <option value="SA">SA</option>
                            <option value="ACT">ACT</option>
                        </select>
                    </div>

                    <div class="group">
                        <label for="Suburb">Suburb *</label>
                        <input type="text" name="suburb" id="suburb" required="required">
                    </div>

                    <div class="group">
                        <label for="country">Country *</label>
                        <select name="country" id="country" required="required">
                            <option value="">Choose..</option>
                            <option value="Australia">Australia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="China">China</option>
                        </select>
                    </div>

                    <div class="group">
                        <label for="city">City *</label>
                        <input name="city" id="city" required="required">
                    </div>

                    <div class="return">
                        <div class="row">
                            <div>Total Quantity</div>
                            <div class="totalQuantity">
                                <?php echo $totalQty ?>
                            </div>
                        </div>
                        <div class="row">
                            <div>Total Price</div>
                            <div class="totalPrice">
                                $
                                <?php echo $totalPrice ?>
                            </div>
                        </div>
                    </div>

                    <button class='buttonCheckout'>
                        <input id="sub" type="submit"></input>
                        Submit
                    </button>           

                </form>

            </div>
        </div>
    </div>

</body>

</html>