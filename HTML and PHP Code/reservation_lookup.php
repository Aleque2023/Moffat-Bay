<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Lookup</title>
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
    <section id="account-selection">
        <h2>Find My Reservation</h2>
        <form action="reservation_lookup_code.php" method="post">
            <label for="username">Username (Email):</label>
            <input type="email" id="username" name="username" required>
            <button type="submit">Select</button>
        </form>
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