<?php 
    include ("user_login.php"); 

    // Include database connection


    // Check if the user is logged in
    if(isset($_SESSION['Email'])) {
        // Get the user's email
        $userEmail = $_SESSION['Email'];

        // Query to select data from the database based on the user's email
        $query = "SELECT * FROM orders WHERE Email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Food Website</title>
    <link rel="stylesheet" href="styles/logined.css"/>
    <style>
        .container1 {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .order-container {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 300px;
        }

        .order-container p {
            margin: 0;
        }

        .order-container strong {
            font-weight: bold;
        }

        .container2 {
            width: 100%;
            padding: 20px;
        }

        .menu-container {
            display: flex;
            flex-direction: column;
        }

        #mobile-view {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container2">
        <div class="menu-container">
            <div id="menu">
                <div class="title">
                    <img src="img/foodie hunter.png" alt=""/>
                </div>
                <div class="menu-item">
                    <a href="logined.php">Home</a>
                    <a href="aboutus.html">About</a>
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
                <div class="mobile-footer">
                    <p>Home</p>
                    <p>Cart</p>
                    <p>offers</p>
                    <p>orders</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Display the table -->
    <div class="container1">
        <?php 
            while($row = $result->fetch_assoc()) {
        ?>
        <div class="order-container">
            <p>
                <strong>Item Names:</strong> <?php echo nl2br($row['items']); ?><br>
                <strong>Total Price:</strong> <?php echo $row['total_price']; ?><br>
                <strong>User Address:</strong> <?php echo $row['user_address']; ?><br>
            </p>
        </div>
        <?php 
            }
            // Close the result set and statement
            $result->close();
            $stmt->close();
        ?>
    </div>

    <?php 
        } else {
            // If user is not logged in, display a message or handle it accordingly
            echo "<p>Please login to view your orders.</p>";
        }
    ?>
</body>
</html>