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
    <section id="about">
        <h2>About Us</h2>
        <h3>Welcome to Moffat Bay Marina</h3>
        <p>Learn more about our history, services, and what makes us the best marina in the area.</p>

        <h3>Mission Statement</h3>
        <p>
            At Moffat Bay, we value your business. As avid boaters, we understand the importance of a good marina experience. Established by Mr. and Mrs. Moffat in 1957, Moffat Bay has been caring for boats for over 67 years! Our foundation is built on three essential values: trust, care, and respect. These values guide our team to deliver an exceptional marina experience every time. You can have peace of mind knowing your boat is in good hands. 
        </p>
        <p>
            If there is any way we can improve your experience here, please send us a message using the form below.
        </p>
        <hr>

        <h3>Services Offered</h3>
        <h4>Slip Reservation Costs</h4>
        <p>
            Monthly Rate: $10 per foot + $10 for electric power.<br>
            Example: 34 ft boat = $340 + $10 = $350/month
        </p>

        <h4>Maintenance/Repair</h4>
        <p>
            At Moffat Bay, we prioritize our clients' needs! If you require maintenance or repairs, give us a call, and we will take care of it right away!
        </p>

        <h4>Security</h4>
        <p>
            We value your boats and strive to provide peace of mind. Our security staff ensures that your boats are well looked after!
        </p>
        <hr>
    </section>

    <section id="contact">
        <div id="contact-form">
            <h2>Message Us Today!</h2>
            <form action="submit_message_form.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
        
        <div id="contact-info">
            <h2>Contact Us</h2>
            <p>Address: 123 Marina Drive, Moffat Bay, USA</p>
            <p>Phone: <a href="tel:+11234567890">(123) 456-7890</a></p>
            <p>VHF Channel: 16</p>
        </div>
    </section>
</main>

<footer>
    <address>
        Contact us at <a href="mailto:info@moffatbaymarina.com">info@moffatbaymarina.com</a><br>
        Address: 123 Marina Drive, Moffat Bay, USA<br>
        Phone: <a href="tel:+11234567890">(123) 456-7890</a><br>
        VHF Channel: 16
    </address>
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