<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Register for an account at Moffat Bay Marina to enjoy exclusive access to our facilities.">
    <title>Register - Moffat Bay Marina</title>
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
            <div class="form-container">
                <form action="register_code.php" method="POST">

                    <div class="reg">
                        <label for="firstname">First Name:</label>
                        <input id="firstname" type="text" name="firstname" required>
                    </div>

                    <div class="reg">
                        <label for="lastname">Last Name:</label>
                        <input id="lastname" type="text" name="lastname" required>
                    </div>

                    <div class="reg">
                        <label for="email">Email:</label>
                        <input id="email" type="email" name="email" required>
                    </div>

                    <div class="reg">
                        <label for="username">Username:</label>
                        <input id="username" type="text" name="username" required>
                    </div>

                    <div class="reg">
                        <label for="password">Password:</label>
                        <input id="password" type="password" name="password" autocomplete="new-password" required>
                    </div>

                    <div class="register-btn">
                        <button type="submit" aria-label="Register your account">Register</button>
                    </div>

                    <p class="login-link">
                        Already have an account?
                        <br>
                        <a href="login.php">Login Here</a>
                    </p>

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