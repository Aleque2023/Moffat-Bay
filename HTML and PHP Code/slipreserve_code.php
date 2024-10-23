<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check for required POST fields
    if (!isset($_POST['boatname'], $_POST['boatlen'], $_POST['checkin'], $_POST['checkout'])) {
        echo "<p>Error: Missing required fields.</p>";
        exit;
    }

    // Sanitize and validate inputs
    $boat_name = htmlspecialchars($_POST['boatname']);
    $boat_length = (int)$_POST['boatlen'];
    $check_in_date = htmlspecialchars($_POST['checkin']);
    $check_out_date = htmlspecialchars($_POST['checkout']);
    
    if ($boat_length <= 0 || $boat_length > 50) {
        echo "<p>Error: Boat length must be between 1 and 50 feet.</p>";
        exit;
    }

    $price_per_foot = 10;
    $electric_power_fee = 10;
    $extra_large_slip_fee = 20;
    $total_cost = ($price_per_foot * $boat_length) + $electric_power_fee;

    // Database connection parameters
    $servername = "localhost";
    $dbuser = "student1";  
    $dbpass = "pass";      
    $dbname = "marina";

    // Create connection
    $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        echo "<p>Unable to connect to the database. Please try again later.</p>";
        exit;
    }

    // Fetch reservations that overlap with the desired dates
    $sql = "SELECT slipid FROM reservations 
            WHERE (startdate <= ? AND enddate >= ?) 
            OR (startdate <= ? AND enddate >= ?)
            OR (startdate >= ? AND enddate <= ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo "<p>Error preparing statement: " . $conn->error . "</p>";
        exit;
    }
    
    $stmt->bind_param("ssssss", $check_in_date, $check_in_date, $check_out_date, $check_out_date, $check_in_date, $check_out_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservations = [];
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row['slipid'];
    }
    $stmt->close();

    // Fetch slips that match the boat length requirement
    $sql = "SELECT slipid, slipnumber, slipsize, sliplocation FROM slips 
            WHERE slipsize >= ? ORDER BY slipsize ASC";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo "<p>Error preparing statement: " . $conn->error . "</p>";
        exit;
    }

    $stmt->bind_param("i", $boat_length);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Moffat Bay Marina</title>
            <link rel='stylesheet' href='styles.css'>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Amaranth:ital,wght@0,400;0,700;1,400;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap' rel='stylesheet'>
        </head>";

        echo "
        <header>
            <img src='images/logo.png' alt='Marina Bay Logo' class='logo'>
            <h1>Explore Moffat Bay Marina</h1>
            <nav>
                <ul>
                    <li><a href='landingpage.php'>Home</a></li>
                    <li><a href='about.php'>About Us</a></li>
                    <li><a href='login.php'>Login/Register</a></li>
                </ul>
            </nav>
        </header>";
        
        echo "<h1 style='max-width:350px;margin:auto;text-align:left;'>Available Slips for Reservation</h1>";
        echo "<form method='POST' action='reservation_summary.php'>";
        echo "<table border='1'>";
        echo "<tr><th>Slip Number</th><th>Slip Size</th><th>Slip Location</th><th>Action</th></tr>";
        
        $available_slips = false;
        while ($row = $result->fetch_assoc()) {
            $slip_id = $row["slipid"];
            $slip_number = $row["slipnumber"];
            $slip_size = $row["slipsize"];
            $slip_location = $row["sliplocation"];

            if (in_array($slip_id, $reservations)) {
                continue;
            }
            $available_slips = true;
            $final_cost = $total_cost;
            if ($slip_size == 50 && $boat_length <= 40) {
                $final_cost += $extra_large_slip_fee;
            }

            echo "<tr>";
            echo "<td>" . htmlspecialchars($slip_number) . "</td>";
            echo "<td>" . htmlspecialchars($slip_size) . " ft</td>";
            echo "<td>" . htmlspecialchars($slip_location) . "</td>";
            echo "<td><button type='submit' name='slip' value='" . htmlspecialchars($slip_id) . "'>Reserve This Slip</button></td>";
            echo "</tr>";
        }
        echo "</table>";
        
        if ($available_slips) {
            echo "<p>Total Cost: $" . number_format($final_cost, 2) . "</p>";
        } else {
            echo "<p>No available slips for the requested size and dates.</p>";
        }
        
        echo "</form>";
    } else {
        echo "<p>Sorry, no slips are available for the requested size.</p>";
    }

    echo "<footer>";
    require "footer.html";
    echo "</footer>";
    
    $stmt->close();
    $conn->close();
}
?>