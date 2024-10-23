<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moffat Bay Marina</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Amaranth:ital,wght@0,400;0,700;1,400;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <img src="images/logo.png" alt="Marina Bay Logo" class="logo">
    <h1>Explore Moffat Bay Marina</h1>
    <nav>
        <ul>
            <li><a href="landingpage.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="login.php">Login/Register</a></li>
            <?php
            if (isset($_SESSION['username'])) {
                echo "Logged in as: " . $_SESSION['username'];
            }
            ?>
        </ul>
    </nav>
</header>
<main>
<?php
$servername = "localhost";
$dbusername = "student1";  
$dbpassword = "pass";      
$dbname = "marina";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST['username']);

    $stmt = $conn->prepare("SELECT userid FROM users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        echo "<p>Sorry, we couldn't find you in our system.</p>";
    } else {
        $row = $result->fetch_assoc();
        $userid = $row['userid'];

        $stmt = $conn->prepare("
            SELECT reservations.reservationdate, reservations.startdate, reservations.enddate, 
                   slips.slipnumber, slips.slipsize, slips.sliplocation
            FROM reservations 
            INNER JOIN slips ON reservations.slipid = slips.slipid 
            WHERE reservations.userid = ?");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            echo "<p>Sorry, we couldn't find any reservations under your name.</p>";
        } else {
            ?>
            <section id="reservation-table">
            <h2>My Reservations</h2>
            <table>
                <tr>
                    <th>Reservation Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>        
                    <th>Slip Number</th>
                    <th>Slip Size</th>
                    <th>Slip Location</th>
                </tr>
            <?php 
            while($rows = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $rows['reservationdate']; ?></td>
                    <td><?php echo $rows['startdate']; ?></td>
                    <td><?php echo $rows['enddate']; ?></td>
                    <td><?php echo $rows['slipnumber']; ?></td>
                    <td><?php echo $rows['slipsize']; ?></td>
                    <td><?php echo $rows['sliplocation']; ?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            </section>
            <?php
        }
    }
    $stmt->close();
}
$conn->close();
?>
</main>
<footer>
    <?php require "footer.html"; ?>
</footer>
</body>
</html>
