<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: sign_up_page.php");
    exit;
}

if (!isset($_SESSION['timestamp'])) {
    $_SESSION['timestamp'] = time();
}

$timeout_minutes = 10;

// Check if the session has timed out
if (time() - $_SESSION['timestamp'] > $timeout_minutes * 60) {
    // Destroy the session and log the user out
    session_destroy();
    header("Location: sign_up_page.php");
    exit();
}

// Update the session timestamp
$_SESSION['timestamp'] = time();

// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "users");

// Retrieve the user's name from the database
$username = $_SESSION['username'];
$query = "SELECT name, username FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the query result and get the name value
    $row = $result->fetch_assoc();
    $name = $row['name'];
} else {
    // Display an error message if the query failed
    $name = "Error: " . $mysqli->error;
}
?>

<script>
    var timeout_seconds = <?php echo $timeout_minutes * 60; ?>;

    var countdown_timer = setInterval(function() {
        timeout_seconds--;
        if (timeout_seconds <= 0) {
            clearInterval(countdown_timer);
            window.location.href = "index.php";
        }
    }, 1000);

    document.addEventListener("mousemove", reset_timer);
    document.addEventListener("keypress", reset_timer);

    function reset_timer() {
        timeout_seconds = <?php echo $timeout_minutes * 60; ?>;
    }
</script>

<!DOCTYPE html>
<html lang="en" class="bg-image">
    <head>
        <meta charset="UTF-8">
        <title>Summon</title>


        <!-- Linking bootstrap framework-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <!-- Linking css file and favicon-->
        <link rel="stylesheet" href="/soen341/css/style.css">
        <link rel="icon" href="favicon.ico">

        <!-- Linking font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    </head>

    <!-- Sample code take from ChatGPT -->
    <body class="bg-image">
         <!-- Navigation Bar (top)-->
         <nav class="navbar navbar-expand-md navbar-dark bg-dark">

            <a class="navbar-brand summon-font" href="/soen341/index.php" style="margin-left: 16px;">
                <h1 class="brand-name" style="margin: auto;">
                    Summon
                </h1>
            </a>

            <!-- Dynamic Button for mobile/small screen-->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: 20px;">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Elements in navbar-->
            <div class="collapse navbar-collapse summon-font" id="navbarSupportedContent">
                
                <ul class="navbar-nav ms-auto" style="margin-right: 20px; font-size: 21px; padding-left: 45%;">

                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/index.php">
                            Home
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbar-text" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Search
                        </a>

                        <!-- Dropdown menu-->
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item navbar-text" href="#" style="color: #212529">
                                    Find Opportunities
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item navbar-text" href="#" style="color: #212529">
                                    Open a Position
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/dashboard.php">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="/soen341/log_out.php">
                            Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Start of Page Here-->
        <div class="table" style="margin: auto; margin-top: 8%">
            <div class="row" style="width: 800px; margin: auto;">
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Username</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Name</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Education</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Location</h3></div>
            </div>
            <div class="row" style="width: 800px; margin: auto">
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $username ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $name ?></p></div>
            </div>
        </div>
    

        <div class="bottom-container" style="height: 50px; padding-bottom: 0px; padding-top: 10px;">
            <p class="text-white" style="font-size: 1vmax;">
                Summon © 2023
            </p>

        </div>
    </body>
</html>