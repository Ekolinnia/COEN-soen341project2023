<?php include '../../DB_PASSWORD.php' ?>
<?php include '../Homepage/BACK_timeout.php' ?>

<?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", DB_PASSWORD, "users");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the applicant's information from the database
    if(isset($_GET["usr"])){
        $query = "SELECT name, username, education, mylocation, experience, skills, availability, languages FROM users WHERE username='" . urldecode($_GET["usr"]) . "'";
        $result = $conn->query($query);
    }
    else{
        echo '<div class="d-flex flex-column align-items-center" style="margin-top: 2%">';
        echo '<h1 class="text-white text-center" style="font-size: 2vw; margin-top: 10%">Error, missing Applicant Information</h1>';
        echo '</div>';
        die();
    }

    // Check if the query was successful
    if ($result) {
        // Fetch the row from the query result and get the name value
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $education = $row['education'];
        $mylocation = $row['mylocation'];
        $experience = $row['experience'];
        $skills = $row['skills'];
        $availability = $row['availability'];
        $languages = $row['languages'];
    }
    else {
        // Display an error message if the query failed
        $name = "Error: " . $mysqli->error;
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TalentHub</title>


        <!-- Linking bootstrap framework-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <!-- Linking css file and favicon-->
        <link rel="stylesheet" href="/soen341/css/style.css">
        <link rel="icon" href="/soen341/images/favicon.ico">

        <!-- Linking font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400&display=swap" rel="stylesheet">
    </head>

    <body class="background-image">
    <?php include '../Navbar/navbar.php' ?>
    
        <div class="table table-hover" style="margin: auto; margin-top: 1%; text-align: center;">
            <div class="cell" style="width: 15%"><a href="employer_postings.php" class="btn btn-light btn-lg outer2" style="background-color: #ffffff; margin-left: 2%; margin-top: 2%; margin-bottom: 5%; width: 80%">Back to Postings</a></div>    
            <div class="row" style="margin-left: 5%; width: 100%; text-align: center">
                <div class="cell" style="width: 19%"><h2 style="font-size: 1.9vw;">Full Name</h2></div>
                <div class="cell" style="width: 19%"><h2 style="font-size: 1.9vw;">Education</h2></div>
                <div class="cell" style="width: 19%"><h2 style="font-size: 1.9vw;">Residence</h2></div>
                <div class="cell" style="width: 19%"><h2 style="font-size: 1.9vw;">Languages</h2></div>
                <div class="cell" style="width: 19%"><h2 style="font-size: 1.9vw;">Skills</h2></div>
            </div>
            <div class="row" style="width: 100%; margin-left: 5%; text-align: center">
                <div class="cell" style="width: 19%"><h2 class="text-white" style="font-size: 1.1vw"><?php echo $name ?></h2></div>
                <div class="cell" style="width: 19%"><h2 class="text-white" style="font-size: 1.1vw"><?php echo $education ?></h2></div>
                <div class="cell" style="width: 19%"><h2 class="text-white" style="font-size: 1.1vw"><?php echo $mylocation ?></h2></div>
                <div class="cell" style="width: 19%"><h2 class="text-white" style="font-size: 1.1vw"><?php echo $languages ?></h2></div>
                <div class="cell" style="width: 19%"><h2 class="text-white" style="font-size: 1.1vw"><?php echo $skills ?></h2></div>
            </div>
        </div>

        <div class="table table-hover" style="margin: auto; margin-top: 4%; text-align: center">
            <div class="row" style="width: 75%; margin: auto; text-align: center"> 
                <div class="cell" style="width: 50%"><h2 style="font-size: 2vw">Experience</h2></div>
                <div class="cell" style="width: 50%"><h2 style="font-size: 2vw">Availability</h2></div>
            </div>
            <div class="row" style="width: 75%; margin: auto; text-align: center"> 
                <div class="cell" style="width: 50%"><h2 class="text-white" style="font-size: 1.1vw"><?php echo $experience ?></h2></div>
                <div class="cell" style="width: 50%"><h2 class="text-white" style="font-size: 1.1vw"><?php echo $availability ?></h2></div>
            </div>
            <hr>
            <?php
            $_SESSION['usr'] = urldecode($_GET["usr"]);
            include '../Students/BACK_display_pdf.php';
            ?>
        </div>
        <div class="profile_buttons">
        <form method="post" action="BACK_interview.php?appid=<?php echo urldecode($_GET["appid"]) ?>">
            <button href="employer_dashboard.php" type="submit" class="btn btn-primary btn-lg outer" style="margin: auto; width: 25%"><h1 style="font-size: 2vw">Select for Interview</h1></a>
        </div>
        <hr>
    </body>
</html>

