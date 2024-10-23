<?php
session_start();

$servername = "localhost";
$dbUsername = "student1";  // Change this to your MySQL username
$dbPassword = "pass";      // Change this to your MySQL password
$dbname = "marina";

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed. Please try again later.");
}

// Check if the form data exists
if (isset($_POST['username']) && isset($_POST['password'])) {
    $formUsername = $_POST['username'];
    $formPassword = $_POST['password'];

    // Prepare SQL query to check user credentials
    $sql = "SELECT userid, username, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $formUsername);
    
    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if ($formPassword == $user['password']) {
            // Start session and redirect to the landing page
            $_SESSION['username'] = $user['username'];
            header("Location: landingpage.php");
            exit();
        } else {
            // Invalid password
            header("Location: login.php?error=invalid_password");
            exit();
        }
    } else {
        // User not found
        header("Location: login.php?error=user_not_found");
        exit();
    }

    $stmt->close();
} else {
    // If data is not set, redirect back to login with an error
    header("Location: login.php?error=missing_data");
    exit();
}

$conn->close();
?>
