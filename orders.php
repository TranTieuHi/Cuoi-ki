<?php
    include("connection.php");

    // Read the JavaScript file
    $fileContents = file_get_contents('scripts/cartData.js');

    // Extract the JavaScript object from the file contents
    preg_match('/var\s+cartData\s*=\s*(\{[^;]*\})\s*;/', $fileContents, $matches);

    if (count($matches) < 2) {
        die('Could not find cartData object in cartdata.js');
    }

    // Debug: Print the matched contents
    

    // Decode the JSON string to PHP array
    $cartDataArray = json_decode($matches[1], true);

    
    // Check if the 'order' key exists in the decoded array
    if (!isset($cartDataArray['order'])) {
        die('Invalid cartData format: order key not found');
    }

    // Extract cart data
    $order = $cartDataArray['order'];

    // Prepare item names (handle special characters properly)
    $itemnames = isset($order['itemnames']) ? implode(", ", array_map(function($item) use ($conn) {
        return $conn->real_escape_string($item);
    }, $order['itemnames'])) : '';

    // Extract other data
    $totalprice = isset($order['totalprice']) ? $order['totalprice'] : 0;
    $userEmail = isset($order['userEmail']) ? $order['userEmail'] : '';
    $address = isset($order['address']) ? $order['address'] : '';

    // Prepare SQL statement to insert cart data into the database
    $stmt = $conn->prepare("INSERT INTO orders (items, total_price, user_address, Email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $itemnames, $totalprice,  $address, $userEmail);

    // Execute statement
    $stmt->execute();

    

    // Close statement
    $stmt->close();
?>
