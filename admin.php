<?php 
    include ("connection.php");

    // Query to get orders
    $query_orders = "SELECT * FROM orders";
    $stmt_orders = $conn->prepare($query_orders);
    $stmt_orders->execute();
    $result_orders = $stmt_orders->get_result();

    // Sum up total prices
    $totalSum = 0;
    while ($row = $result_orders->fetch_assoc()) {
        $totalSum += $row['total_price'];
    }

    // Query to count orders
    $query_count = "SELECT COUNT(*) AS order_count FROM orders";
    $stmt_count = $conn->prepare($query_count);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();
    $orderCount = $row_count['order_count'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="side-menu">
            <li><a href="#"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="admin_users.php"><i class='bx bx-group'></i>Users</a></li>
            <li><a href="dish_admin.php"><i class='bx bx-group'></i>Dish</a></li>
            <li><a href="feedback_admin.php"><i class='bx bx-group'></i>Feedback</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="login.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>Total Number of Orders: <?php echo $orderCount; ?></h3>
                        <p>Paid Order</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>$<?php echo number_format($totalSum, 2); ?></h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>
            <!-- End of Insights -->

            <!-- Recent Orders -->
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Orders</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Order</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Rewind the result set to loop through it again
                                $result_orders->data_seek(0);
                                while($row = $result_orders->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['items']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                            </tr>
                            <?php 
                                }
                                // Close the result set and statement
                                $result_orders->close();
                                $stmt_orders->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Recent Orders -->
        </main>
    </div>

    <script src="scripts/admin.js"></script>
</body>

</html>
