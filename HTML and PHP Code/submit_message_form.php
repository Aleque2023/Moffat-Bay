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
	
<div id="message-results">
<?php ini_set('display_errors','Off'); ?>
<?php
function verifyTextInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = verifyTextInput($_POST['name']);
$email = filter_var(verifyTextInput($_POST['email']), FILTER_VALIDATE_EMAIL);
$msg = verifyTextInput($_POST['message']);

if (!$email) {
    echo "<h1>Invalid email address!</h1><h2>Please go back and enter a valid email.</h2>";
    exit;
}

if (strlen($msg) >= 70) {
    $msg = wordwrap($msg, 70);
}

$to = "info@moffatbaymarina.com";
$subject = "Contact Form Inquiry";
$message = "From: $name at $email\n\nMessage:\n$msg";
$headers = "From: " . $email . "\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "<h1>Message successfully sent!</h1><h2>We will get back to you as soon as possible!</h2>";
} else {
    echo "<h1>Message not sent!</h1><h2>Please try again later or contact us directly.</h2>";
}
?>
</div>
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