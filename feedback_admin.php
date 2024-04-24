<?php 
    include ("connection.php");
    $query = "SELECT * FROM feedback";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin</title>
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>

        
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="side-menu">
            <li><a href="admin.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="#"><i class='bx bx-group'></i>Users</a></li>
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

        <!-- Buttons -->
        
        <!-- End of Buttons -->

            <main>
                <div class="header">
                    <div class="left">
                        <h1>Dashboard</h1>
                    </div>
                </div>
                <!-- Items Container -->
                <div id="item-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Feedback</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['feedback']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                            </tr>
                            <?php 
                                }
                                // Close the result set and statement
                                $result->close();
                                $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            <!-- End of Items Container -->
        </main>

    </div>

    
    <script src="scripts/admin.js"></script>

</body>
</html>
