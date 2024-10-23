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
  <div class="container">
    <section aria-labelledby="highlights" class="flex-center">
      <h2 id="highlights">Explore Moffat Bay Marina</h2>
      <div class="card">
        <img src="images/marina.jpg" alt="Panoramic view of Moffat Bay Marina, with boats and calm water" class="responsive-img">
        <h3>Beautiful Scenery</h3>
        <p>Enjoy stunning views and a peaceful environment.</p>
      </div>

      <div class="card">
        <img src="images/amenities.jpg" alt="Premium marina amenities, featuring clean facilities and modern dock" class="responsive-img">
        <h3>Premium Amenities</h3>
        <p>Access top-notch facilities and services.</p>
      </div>

      <div class="card">
        <img src="images/community.jpg" alt="Boaters gathered together, smiling at Moffat Bay Marina" class="responsive-img">
        <h3>Vibrant Community</h3>
        <p>Join a community of passionate boaters.</p>
      </div>
    </section>
  </div>

  <div class="container">
    <section aria-labelledby="cta" class="flex-center">
      <h2 id="cta">Ready to Set Sail?</h2>
      <div class="cta">
        <a href="register.php" class="button hero-button">Register Now</a>
        <a href="slipreserve.php" class="button cta-button">Make a Reservation</a>
          <a href="reservation_lookup.php" class="button cta-button">Look up your Reservation</a>
      </div>
    </section>
  </div>

  <div class="container">
    <section aria-labelledby="benefits" class="flex-center">
      <h2 id="benefits">Why Choose Us?</h2>
      <ul class="benefits-list">
        <li>Secure and well-maintained slips</li>
        <li>Convenient location with easy access to local attractions</li>
        <li>Friendly staff dedicated to your boating experience</li>
        <li>Competitive pricing and flexible options</li>
      </ul>
    </section>
  </div>

  <div class="container">
    <section aria-labelledby="testimonials">
      <h2 id="testimonials">What Our Boaters Say</h2>
      <div class="testimonial">
        <img src="images/salmon-clipart.png" alt="Simple illustration of a salmon fish, representing local wildlife" class="responsive-img">
        <p>"Moffat Bay Marina is my home away from home. The views are breathtaking, and the staff is incredibly helpful!"</p>
        <span>- John D.</span>
      </div>

      <div class="testimonial">
        <p>"I've been to many marinas, but none compare to the experience at Moffat Bay. Highly recommended!"</p>
        <span>- Sarah K.</span>
      </div>
    </section>
  </div>
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