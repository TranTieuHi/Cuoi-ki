<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Delete Users</title>
    <style>
        /* General styling */
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
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }

        /* Sidebar styling */
        .sidebar {
            background-color: #333;
            color: #fff;
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 15px;
            cursor: pointer;
        }
        .sidebar ul li:hover {
            background-color: #444;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        /* Content styling */
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header {
            margin-bottom: 20px;
        }

        /* Navbar styling */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-input {
            display: flex;
            align-items: center;
        }
        .form-input input[type="search"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 5px;
        }
        .form-input button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-input button:hover {
            background-color: #0056b3;
        }
        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }
        .logout {
            display: flex;
            align-items: center;
            color: #fff;
        }
        .logout i {
            margin-right: 5px;
        }
        .theme-toggle {
            cursor: pointer;
            position: relative;
        }
        .theme-toggle::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 0;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #ccc;
            transition: background-color 0.3s ease;
        }
        .theme-toggle::after {
            content: '';
            position: absolute;
            top: 6px;
            left: 4px;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background-color: #fff;
            transition: transform 0.3s ease;
        }
        input[type="checkbox"]#theme-toggle:checked + .theme-toggle::before {
            background-color: #007bff;
        }
        input[type="checkbox"]#theme-toggle:checked + .theme-toggle::after {
            transform: translateX(15px);
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <ul class="side-menu">
        <li><a href="admin.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        
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

<!-- User Deletion Section -->
<div class="container">
    <?php
    // Include the database connection script
    include ('connection.php');

    // Check if email is provided for deletion
    if (isset($_GET['email'])) {
        // Use mysqli_real_escape_string to prevent SQL injection
        $email = $conn->real_escape_string($_GET['email']);

        // SQL to delete user based on email
        $sql = "DELETE FROM user_login WHERE Email = '$email'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User deleted successfully');</script>";
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    }

    // Fetch users from the database
    $sql = "SELECT * FROM user_login";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each user in a table
        echo "<table>";
        echo "<tr><th>Email</th><th>Username</th><th>Phone Number</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['Email']}</td>";
            echo "<td>{$row['Username']}</td>";
            echo "<td>{$row['SDT']}</td>";
            // Encode email for URL to prevent issues with special characters
            $encoded_email = urlencode($row['Email']);
            // Display link for deleting the user
            echo "<td><a class='delete-link' href='delete_account.php?email={$encoded_email}'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
<!-- End of User Deletion Section -->

</body>
</html>
