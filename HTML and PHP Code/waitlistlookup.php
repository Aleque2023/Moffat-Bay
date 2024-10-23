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
                echo "<li><div id='dropcontainer'>
                <button id='dropbtn'>Menu</button>
                <div id='dropsites'>
                <a href='waitlistlookup.php'>Waitlist Lookup</a>
                <a href='slipreserve.php'>Slip Reservation</a>
                <a href='reservation_lookup.php'>Lookup Reservation</a>
                <a href='logout.php'>Logout</a>
                </div>
                </div></li>";
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <section>
        <div id="container">
            <form action="" method="POST">
                <div>
                    <label for="slipsize">Slip Size:</label>
                    <select name="slipsize" id="slipsize" required>
                        <option value="20">20 ft</option>
                        <option value="40">40 ft</option>
                        <option value="50">50 ft</option>
                    </select>
                </div>
                
                <div id="waitlistbtn">
                    <button type="submit">Check # of Customers Waiting</button>
                </div>

                <?php
                session_start();

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $slipsize = htmlspecialchars($_POST['slipsize']);

                    // Database connection settings
                    $servername = "localhost";
                    $dbuser = "student1";
                    $dbpass = "pass";
                    $dbname = "marina";

                    // Establish database connection
                    $con = new mysqli($servername, $dbuser, $dbpass, $dbname);

                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    // SQL Query to get the waitlist count
                    $sql = "SELECT COUNT(waitlist.slipid) AS waiting_count 
                            FROM slips 
                            INNER JOIN waitlist ON slips.slipid = waitlist.slipid 
                            WHERE slips.slipsize >= ?";

                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("i", $slipsize);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Display waitlist count in a table
                    echo "<table border='1'>";
                    echo "<tr><th>Customers Waiting for Slip Size: $slipsize ft</th></tr>";
                    echo "<tr><td id='quantity'>";

                    if ($result && $row = $result->fetch_assoc()) {
                        echo $row['waiting_count']; 
                    } else {
                        echo "0"; 
                    }

                    echo "</td></tr></table>";

                    $stmt->close();
                    $con->close();
                }
                ?>
            </form>
        </div>
    </section>
</main>

<footer>
    <?php require "footer.html"; ?> 
</footer>

</body>
</html>

<style>
  #dropbtn {
    background-color: #052F5F;
    color: white;
    padding: 1em;
    border: none;
    border: 1px solid black;
  }

  #dropcontainer {
    position: relative;
    display: inline-block;
  }

  #dropsites {
    display: none;
    position: absolute;
    background-color: #052F5F;
    min-width: 100px;
    z-index: 1;
  }

  #dropsites a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  #dropsites a:hover {
    background-color: #ddd;
  }


  #dropcontainer:hover #dropsites {
    display: block;
  }


  #dropcontainer:hover #dropbtn {
    background-color: #44B9B9;
    text-decoration: underline;
  }
</style>