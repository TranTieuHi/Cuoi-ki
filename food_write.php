<?php
// Include the connection file
include("connection.php");

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all items from the Dish table
$sql = "SELECT * FROM Dish";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Open food.js file for writing
    $file = fopen("scripts/food.js", "w");

    // Write the beginning of the JavaScript array
    fwrite($file, "const foodItem = [\n");

    // Loop through each row of the result and write the data to the food.js file
    while ($row = $result->fetch_assoc()) {
        fwrite($file, "{\n");

        // Write all fields including description
        fwrite($file, "  name: '" . addslashes($row['Name']) . "',\n");
        fwrite($file, "  category: '" . addslashes($row['Catogries']) . "',\n");
        fwrite($file, "  rating: " . $row['Rating'] . ",\n");
        fwrite($file, "  price: " . (float)$row['Price'] . ",\n");
        fwrite($file, "  img: '" . $row['img'] . "',\n");
        fwrite($file, "  quantity: " . (int)$row['quantity'] . ",\n");
        fwrite($file, "},\n");
    }

    // Write the end of the JavaScript array
    fwrite($file, "];\n");
    fwrite($file, "export { foodItem };");

    // Close the file
    fclose($file);

} else {
    echo "No data found in the database.";
}

// Close the database connection
?>
