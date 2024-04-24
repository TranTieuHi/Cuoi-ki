<?php


    // Receive content from the JavaScript
    $data = json_decode(file_get_contents("php://input"));

    // Write content to a file
    $file = fopen("scripts/cartData.js", "w") or die("Unable to open file!");
    fwrite($file, $data->content);
    fclose($file);

    // Respond with success message
    echo "Cart data has been saved to file.";
?>
