

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Delete Items</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        table img {
            max-width: 100px;
            max-height: 100px;
        }
        .delete-link {
            color: red;
            text-decoration: none;
        }
        .home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


        .food-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .food-img {
            margin-right: 20px;
            flex: 0 0 200px;
        }

        .food-img img {
            width: 80%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .food-details {
            flex: 1;
        }

        .food-details h2 {
            margin: 0;
            margin-bottom: 10px;
        }

        .food-details p {
            margin: 0;
            margin-bottom: 5px;
        }

        /* Style for checkboxes */
        .checkbox {
            margin-right: 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Button background color */
            color: #fff; /* Button text color */
            text-decoration: none; /* Remove underline */
            border: none; /* Remove border */
            border-radius: 4px; /* Add border radius */
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Hidden by default */
        .delete-checkbox {
            display: none;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
    <div class="sidebar">
            <ul class="side-menu">
                <li><a href="admin.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
                <li><a href="#"><i class='bx bx-group'></i>Users</a></li>
                <li><a href="dish_admin.php"><i class='bx bx-group'></i>Dish</a></li>
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
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav>
        <!-- End of Navbar -->

        <!-- Buttons -->
        <div>
            <a href="Delete_items.php" class="button">Delete item</a>
            <a href="add_items.php" class="button">Add item</a>
        </div>
        <!-- End of Buttons -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>
            <!-- Items Container -->
            <div id="item-container">
                <!-- JavaScript data will be dynamically inserted here -->
            </div>
            <!-- End of Items Container -->
        </main>
    </div>
    <div class="container">
    <?php
// Include the database connection script
        include 'connection.php';

        // Check if item name is provided for deletion
        if (isset($_GET['delete_name'])) {
            // Use mysqli_real_escape_string to prevent SQL injection
            $delete_name = $conn->real_escape_string($_GET['delete_name']);

            // SQL to delete item based on name
            $sql = "DELETE FROM dish WHERE Name = '$delete_name'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Item $delete_name deleted successfully');</script>";
                include("food_write.php");
            } else {
                echo "Error deleting item: " . $conn->error;
            }
        }

        // Retrieve items from the database
        $sql = "SELECT * FROM dish";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            echo "<table>";
            echo "<tr><th>Name</th><th>Rating</th><th>Price</th><th>Image</th><th>Categories</th><th>Action</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['Rating']}</td>";
                echo "<td>{$row['Price']}</td>";
                echo "<td><img src='{$row['img']}' alt=''></td>";
                echo "<td>{$row['Catogries']}</td>";
                // Use urlencode to properly encode special characters in the URL
                $encoded_name = urlencode($row['Name']);
                echo "<td><a class='delete-link' href='delete_items.php?delete_name={$encoded_name}'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        // Close the connection
        $conn->close();
?>
    </div>
</body>
</html>
