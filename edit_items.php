<?php
// Include the database connection script
    include 'connection.php';

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['data'])) {
        // Flag to track if any update fails
        $updateSuccess = true;
        
        // Loop through each row in the table
        foreach ($_POST['data'] as $originalName => $item) {
            // Prepare UPDATE statement
            $stmt = $conn->prepare("UPDATE dish SET Name=?, Rating=?, Price=?, img=?, Catogries=? WHERE Name=?");
            
            // Check if the statement preparation succeeded
            if ($stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }
            
            // Retrieve values from the table
            $name = $item['Name'];
            $rating = $item['Rating'];
            $price = $item['Price'];
            $img = $item['Image'];
            $categories = $item['Categories'];
            
            // Bind parameters
            $stmt->bind_param("ssssss", $name, $rating, $price, $img, $categories, $originalName);
            
            // Execute the update query
            if (!$stmt->execute()) {
                // Update failed, set flag to false
                $updateSuccess = false;
                // Stop processing further updates
                break;
            }
            
            // Close statement
            $stmt->close();
        }
        
        // If all updates were successful, include food_write.php
        if ($updateSuccess) {
            include("food_write.php");
        }
    }

    $sql = "SELECT * FROM dish";
    $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Edit Items</title>
    <style>
        /* Your CSS styles here */
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
        <!-- Navbar content -->
    </nav>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Edit Items</h1>
            </div>
        </div>
        <!-- Items Display as Table -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table id="itemTable">
                <!-- Table headers -->
                <tr>
                    <th>Name</th>
                    <th>Rating</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Categories</th>
                </tr>
                <!-- Table rows with editable content -->
                <?php
                // Display each item in a table row
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td contenteditable="true">
                                
                                <input name="data[<?php echo htmlspecialchars($row['Name']); ?>][Name]" value="<?php echo htmlspecialchars($row['Name']); ?>">
                            </td>
                            <td contenteditable="true">
                                <input name="data[<?php echo htmlspecialchars($row['Name']); ?>][Rating]" value="<?php echo htmlspecialchars($row['Rating']); ?>">
                            </td>
                            <td contenteditable="true">
                                <input name="data[<?php echo htmlspecialchars($row['Name']); ?>][Price]" value="<?php echo htmlspecialchars($row['Price']); ?>">
                            </td>
                            <td contenteditable="true">
                                <input name="data[<?php echo htmlspecialchars($row['Name']); ?>][Image]" value="<?php echo htmlspecialchars($row['img']); ?>">
                            </td>
                            <td contenteditable="true">
                                <input name="data[<?php echo htmlspecialchars($row['Name']); ?>][Categories]" value="<?php echo htmlspecialchars($row['Catogries']); ?>">
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </table>
            <input type="submit" value="Save Changes">
        </form>
        <!-- End of Items Display -->
    </main>
</div>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
