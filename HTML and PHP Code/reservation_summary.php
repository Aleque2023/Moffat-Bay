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
<header class="header">
    <img src="images/logo.png" alt="Marina Bay Logo" class="logo">
    <h1>Explore Moffat Bay Marina</h1>
    <nav>
        <ul class="nav-list">
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

<main class="main-content">
    <section class="reservation-summary">
        <?php
            session_start();

            $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "Guest";
            $boat_name = isset($_SESSION['boat_name']) ? $_SESSION['boat_name'] : "N/A";
            $boat_length = isset($_SESSION['boat_length']) ? $_SESSION['boat_length'] : "N/A";
            $check_in_date = isset($_SESSION['check_in_date']) ? $_SESSION['check_in_date'] : "N/A";
            $check_out_date = isset($_SESSION['check_out_date']) ? $_SESSION['check_out_date'] : "N/A";
            $total_cost = isset($_SESSION['total_cost']) ? $_SESSION['total_cost'] : "N/A";
        ?>

        <h2>Reservation Summary</h2>
        <table class="summary-table">
            <tr><td>Customer:</td><td><?php echo $username; ?></td></tr>
            <tr><td>Boat Name:</td><td><?php echo $boat_name; ?></td></tr>
            <tr><td>Boat Length:</td><td><?php echo $boat_length; ?> ft</td></tr>
            <tr><td>Check-In Date:</td><td><?php echo $check_in_date; ?></td></tr>
            <tr><td>Check-Out Date:</td><td><?php echo $check_out_date; ?></td></tr>
            <tr><td>Total Cost:</td><td>$<?php echo $total_cost; ?></td></tr>
        </table>
    </section>
</main>

<footer class="footer">
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