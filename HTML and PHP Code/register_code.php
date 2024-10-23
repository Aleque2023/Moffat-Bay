<?php
session_start();

$servername = "localhost";
$dbuser = "student1";  
$dbpass = "pass";      
$dbname = "marina";

// Create connection
$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data and sanitize inputs
    $firstname = trim($conn->real_escape_string($_POST['firstname']));
    $lastname = trim($conn->real_escape_string($_POST['lastname']));
    $email = trim($conn->real_escape_string($_POST['email']));
    $username = trim($conn->real_escape_string($_POST['username']));
    $password = trim($conn->real_escape_string($_POST['password'])); // No need to escape, handled below

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    // Hash password
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email or username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $existing_user = $result->fetch_assoc();
        if ($existing_user['email'] === $email) {
            die("Error: Email is already in use.");
        } elseif ($existing_user['username'] === $username) {
            die("Error: Username is already taken.");
        }
    }

    // Prepare and bind for insert
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password, email, regdate, role) VALUES (?, ?, ?, ?, ?, CURDATE(), 1)");
    $stmt->bind_param("sssss", $firstname, $lastname, $username, $password, $email);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: successfulregistration.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
