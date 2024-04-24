<?php
// Assuming you have a database connection established already
// Replace the placeholders with your actual database connection details
include("user_login.php");
include("connection.php");

// Initialize variables to store user input
$feedback = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
    
    // Get email from session
    $email = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';

    // Insert the feedback into the database
    $sql = "INSERT INTO feedback (feedback, email) VALUES ('$feedback', '$email')";

    if ($conn->query($sql) === TRUE) {
         header("Location: logined.php");
        // exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="style.css"> <!-- Link your CSS file here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding-top: 50px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        textarea.form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Feedback Form</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="feedback">Your Feedback:</label>
                <textarea class="form-control" rows="5" id="feedback" name="feedback" placeholder="Type your feedback here"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>

        </form>
    </div>
</body>

</html>
