<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['slip'])) {
    $slip_number = htmlspecialchars($_POST['slip']); 

    if (!isset($_SESSION['boat_name'], $_SESSION['boat_length'], $_SESSION['check_in_date'], $_SESSION['check_out_date'], $_SESSION['total_cost'])) {
        die("Error: Session variables are not set. Please restart the reservation process.");
    }

    $boat_name = $_SESSION['boat_name'];
    $boat_length = $_SESSION['boat_length'];
    $check_in_date = $_SESSION['check_in_date'];
    $check_out_date = $_SESSION['check_out_date'];
    $total_cost = $_SESSION['total_cost'];

    $servername = "localhost";
    $dbuser = "student1";  
    $dbpass = "pass";      
    $dbname = "marina";

    $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE slips SET availability = 0 WHERE slipnumber = ?";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("s", $slip_number);

    if ($stmt->execute()) {
        echo "<h1>Reservation Successful</h1>";
        echo "<p>Boat Name: $boat_name</p>";
        echo "<p>Boat Length: $boat_length ft</p>";
        echo "<p>Slip Number: $slip_number</p>";
        echo "<p>Total Cost: $" . number_format($total_cost, 2) . " per month</p>";
        echo "<p>Reservation from $check_in_date to $check_out_date has been completed successfully.</p>";
        echo "<a href='index.php'>Return to Homepage</a>";  // Optional: link to homepage or relevant page
    } else {
        echo "<p>Sorry, there was an error with your reservation. Please try again.</p>";
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
