<?php 
    include ("user_login.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Food Website</title>
    <link rel="stylesheet" href="styles/logined.css"/>
    
</head>
<body>
    <?php include("user_login.php"); ?>

    <div class="container" id="container">
        <div id="menu">
            <div class="title">
                <img src="img/foodie hunter.png" alt=""/>
            </div>
            <div class="menu-item">
                <a href="logined.php">Home</a>
                <a href="aboutus.html">About</a>
                <a href="your_order_see.php">Your Orders</a>
                <a href="feedback.php">Feedback</a>
            </div>
        </div>

    <div id="food-container">
        <div id="header">
            <div class="add-box">
                <i class="fa fa-map-marker your-address" id="add-address"> Your Address</i>
            </div>
            <div class="util">
                <input type="text" id="search-box" placeholder="Search for your favorite food">
                <i id="btn-search">Search</i>
                <i class="fa fa-cart-plus" id="cart-plus"> 0 Items</i>
            </div>
        </div>
        <div id="food-items" class="d-food-items">
            <div id="pho" class="d-biryani">
                <p id="category-name">Phở</p>
            </div>

            <div id="com" class="d-chicken">
                <p id="category-name">Cơm</p>
            </div>

            <div id="huTieu" class="d-huTieu">
                <p id="category-name">Hủ Tiếu</p>
            </div>

            <div id="mi" class="d-mi">
                <p id="category-name">Mì</p>
            </div>

            <div id="banhMi" class="d-chinese">
                <p id="category-name">Bánh Mì</p>
            </div>

            <div id="doAnChay" class="d-doAnChay">
                <p id="category-name">Đồ Ăn Chay</p>
            </div>
        </div>

        <div id="cart-page" class="cart-toggle">
            <p id="cart-title">Cart Items</p>
            <p id="m-total-amount">Total Amout : 100</p>
            <table>
                <thead>
                <td>Item</td>
                <td>Name</td>
                <td>Quantity</td>
                <td>Price</td>
                </thead>
                <tbody id="table-body"></tbody>
            </table>
            <div class="btn-box">
                <button class="cart-btn">Checkout</button>
            </div>
        </div>
    </div>

    <div id="cart">
        <div class="taste-header">
            <div class="user">
            <?php
                    if(isset($_SESSION['Username'])) {
                        echo '<div class="user-options">';
                            echo '<a href="profile.php" class="profile-link"><i class="fa fa-user-circle" id="circle">' . $_SESSION['Username'] .'</i></a>';
                            echo '<div class="options">';
                                echo '<a href="login.php">Logout</a>';
                                echo '<a href="profile.php">Profile</a>';
                            echo '</div>';
                        echo '</div>';
                    } 
                ?>
            </div>
        </div>
        <div id="category-list">
            <p class="item-menu">Go For Hunt</p>
            <div class="border"></div>
        </div>
        <div id="checkout" class="cart-toggle">
            <p id="total-item">Total Item : 5</p>
            <p id="total-price"></p>
            <p id="delievery">Free delievery on $ 40</p>
            <button class="cart-btn">Checkout</button>
        </div>
    </div>
</div>

<!-- mobile view -->
<div id="mobile-view" class="mobile-view">
    <div class="mobile-top">
        <div class="logo-box">
            <img src="img/foodielogo.png" alt="" id="logo"/>
            <i class="fa fa-map-marker your-address" id="m-add-address"> Your Address</i>
        </div>
        <div class="top-menu">
            <i class="fa fa-search"></i>
            <i class="fa fa-tag"></i>
            <i class="fa fa-heart-o"></i>
            <i class="fa fa-cart-plus" id="m-cart-plus"> 0</i>
        </div>
    </div>

    <div class="item-container">
        <div class="category-header" id="category-header"></div>

        <div id="food-items" class="food-items">
            <div id="pho" class="m-pho">
                <p id="category-name">Phở</p>
            </div>
            <div id="com" class="m-com">
                <p id="category-name">Cơm</p>
            </div>
            <div id="huTieu" class="m-paneer">
                <p id="category-name">Hủ Tiếu</p>
            </div>
            <div id="mi" class="d-mi">
                <p id="category-name">Mì</p>
            </div>
            <div id="banhMi" class="m-banhMi">
                <p id="category-name">Bánh Mì</p>
            </div>
            <div id="doAnChay" class="m-doAnChay">
                <p id="category-name">Đồ Ăn Chay</p>
            </div>
        </div>
    </div>

    <div class="mobile-footer">
        <a href="#">Home</a>
        
        <a href="your_order_see.php">orders</a>
    </div>
</div>

    <script src="scripts/logined.js" type="module"></script>

    <script>
        var userEmail = "<?php echo isset($_SESSION['Email']) ? $_SESSION['Email'] : ''; ?>";
    </script>
</body>
</html>
