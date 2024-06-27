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
        <header>
            <div class="left">
                <a href="index.php"><img src="/images/logo.webp"></a>
                <a href="index.php">
                    <h1>HOME</h1>
                </a>
            </div>

            <div>
                <form id="search_form" action="productSearch.php" method="GET">
                    <input class="search" type="search" name="key" placeholder="Search for products">
                    <input class="submit" type="image" src="/images/search.png" alt="Submit">

                </form>
            </div>

            <div class="iconCart">
                <img src="/images/icon.png">
                <div class="totalQuantity">
                    <?php echo isset ($_SESSION['products']) ? count($_SESSION['products']) : '0' ?>
                </div>
            </div>
        </header>

        <div class="categoryList">
            <?php
            $sql = "SELECT * from Category";
            $cateRes = $conn->query($sql);

            if ($cateRes->num_rows > 0) {
                // output data of each row
                while ($row = $cateRes->fetch_assoc()) {
                    $category_id = $row['category_id'];
                    ?>
                    <div class="drop">
                        <a href="productsByCategory.php?category_id=<?php echo $category_id ?>">
                            <button class="category" type="button">
                                <?php
                                echo $row['category_name'];
                                ?>
                                <img src="/images/down.svg" style="margin-left: 5px;">
                            </button>
                        </a>

                        <ul class="dropdown-menu">

                            <?php
                            $sqlMenus = "select * from SubCategory where category_id =" . $category_id;
                            $productRes = $conn->query($sqlMenus);
                            if ($productRes->num_rows > 0) {
                                while ($productRow = $productRes->fetch_assoc()) {
                                    ?>
                                    <li><a class="dropdown-item"
                                            href="subCategory.php?sub_category_id=<?php echo $productRow['sub_category_id'] ?>">
                                            <?php
                                            echo $productRow["sub_category_name"];
                                }
                            }
                            ?>
                                </a></li>
                        </ul>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="listProduct">

            <?php
            $key = $_GET["key"];

            $sqlSearch = "select * from Products where product_name like '%$key%' or description like '%$key%'";

            $resultSearch = $conn->query($sqlSearch);
            if ($resultSearch->num_rows > 0) {
                while ($rowSearch = $resultSearch->fetch_assoc()) {
                    $id = $rowSearch['product_id'];
                    ?>
                    <div class="item">
                        <img src="images/<?php echo $rowSearch["product_id"]; ?>.jpg">

                        <h2>
                            <?php echo $rowSearch["product_name"]; ?>
                        </h2>
                        <div class="price">$
                            <?php echo $rowSearch["price"]; ?>
                        </div>
                        <?php
                        $stock = $rowSearch['stock_quantity'];
                        if ($stock <= 0) {
                            echo "<div class='stock OutOfStock'>";
                            echo "OUT OF STOCK";
                            echo "</div>";
                            echo "<button style='color:red;background-color:black'>";
                            echo "OUT OF STOCK";
                            echo "</button>";
                        } else {
                            echo "<div class='stock'>";
                            echo "IN STOCK: $stock LEFT";
                            echo "</div>";
                            echo "<a href='addToCart.php?cart_product_id=$id'>";
                            echo "<button>";
                            echo "Add To Cart";
                            echo "</button>";
                            echo "</a>";
                        }
                        ?>
                    </div>

                    <?php
                }
            } else {
                echo "<h1>NO SUCH ITEM!</h1>";
            }

            ?>
        </div>
    </div>

    <div class="cart">
        <h2>
            CART
        </h2>

        <div class="listCart">
            <?php
            if (isset ($_SESSION['products'])) {
                foreach ($_SESSION['products'] as $product) {
                    if ($product['count'] <= 0) {
                        unset($_SESSION['products'][$product['product_id']]);
                        continue;
                    }
                    $count = $product['count'];
                    ?>

                    <div class="item">
                        <img src="/images/<?php echo $product['product_id'] ?>.jpg">
                        <div class="content">
                            <div class="name">
                                <?php echo $product['product_name'] ?>
                            </div>
                            <div class="price">$
                                <?php echo $product['price'] ?>
                            </div>
                        </div>
                        <div class="quantity">

                            <a href="minusQty.php?id=<?php echo $product['product_id'] ?>"><button>-</button></a>

                            <div class="value">
                                   <input type="text" id="qty" name="qty" value="<?php echo $count ?>" readonly>
                            </div>

                            <a href="addQty.php?id=<?php echo $product['product_id'] ?>"><button>+</button></a>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>

        <div class="buttons">
            <div class="totalPrice">
                TOTAL PRICE: $
                <?php
                if (isset ($_SESSION['products'])) {
                    $price = 0;
                    foreach ($_SESSION['products'] as $product) {
                        $price += $product['price'] * $product['count'];
                    }
                    echo $price;
                } else {
                    echo 0;
                }
                ?>

            </div>
            <div class="close">
                CLOSE
            </div>
            <div class="clear">
                <a href="clearCart.php">CLEAR CART</a>
            </div>
            <div class="checkout">
                <?php
                if (isset ($_SESSION['products']) && count($_SESSION['products']) > 0) {
                    echo "<a href='checkout.php' >Place Order</a>";
                } else {
                    echo "<span class='disabled'>Place Order</span>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="app.js"></script>

</body>

</html>