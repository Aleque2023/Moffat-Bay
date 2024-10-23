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
    <nav class="navbar">
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
    <section class="reservation-form">
        <div class="form-container">
            <h2>Reserve Your Slip</h2>
            <form action="slipreserve_code.php" method="POST">
                <div class="form-group">
                    <label for="boatlen">Slip Size:</label>
                    <select name="boatlen" id="boatlen" required>
                        <option value="20">20 ft</option>
                        <option value="40">40 ft</option>
                        <option value="50">50 ft</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="boatname">Boat Name:</label>
                    <input type="text" name="boatname" id="boatname" required>
                </div>

                <div class="form-group">
                    <label for="checkin">Check-In Date:</label>
                    <input type="date" name="checkin" id="checkin" required>
                </div>
                
                <div class="form-group">
                    <label for="checkout">Check-Out Date:</label>
                    <input type="date" name="checkout" id="checkout" required>
                </div>

                <div class="form-group button-container">
                    <button type="submit" class="btn-primary">Check Availability</button>
                </div>
            </form>
        </div>
        
        <div class="image-container">
            <img src="images/slipImg.jpg" alt="Image for the slip page" class="responsive-img">
        </div>
    </section>
</main>

<footer>
    <div class="footer-content">
        <address>
            Contact us at <a href="mailto:info@moffatbaymarina.com">info@moffatbaymarina.com</a><br>
            123 Marina Drive, Moffat Bay, USA<br>
            Phone: <a href="tel:+11234567890">(123) 456-7890</a><br>
            VHF Channel: 16
        </address>
    </div>
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