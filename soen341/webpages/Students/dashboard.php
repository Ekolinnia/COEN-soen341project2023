<?php include '../../DB_PASSWORD.php' ?>
<?php include '../Homepage/BACK_timeout.php' ?>

<?php
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../SignUp/sign_up_page.php");
    exit;
}
?>

<?php
// Check if Student is selected
// Connect to the database
$conn = new mysqli('localhost', 'root', DB_PASSWORD, 'applications');
$student = $_SESSION['username'];

$result = mysqli_query($conn, "SELECT selected FROM applications WHERE student = '$student'");
$selected = 0;
while ($row = mysqli_fetch_assoc($result)){
    $selected = $row['selected'];
    if ($selected == 1){
        //echo $row['selected'];
        break;
    }
}

if ($selected == 1){
    header("Location: dashboard_selected.php");
    exit();     
}
?>

<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", DB_PASSWORD, "users");

// Retrieve the user's name from the database
$username = $_SESSION['username'];
$query = "SELECT usertype, name, username, education, mylocation, experience, skills, availability, languages FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the query result and get the name value
    $row = $result->fetch_assoc();
    $usertype = $row['usertype'];
    $name = $row['name'];
    $education = $row['education'];
    $mylocation = $row['mylocation'];
    $experience = $row['experience'];
    $skills = $row['skills'];
    $availability = $row['availability'];
    $languages = $row['languages'];
} else {
    // Display an error message if the query failed
    $name = "Error: " . $mysqli->error;
}

if($usertype == 'employer') {
    header("Location: ../Employers/employer_dashboard.php");
    exit();
}
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

        <div style="text-align: center; padding-top: 3%;">
            <h1 class="text-white" style="font-size: 4vw; transition: opacity 0.5s ease-out;" id="headline">
                Welcome <?php echo $name; ?>!
            </h1>
            <h3 class="text-white" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                Let's get started.
            </h3>
        </div>

        <script>
            const headlines = ["What's Next?", "Have You Update Your Profile?", "Welcome <?php echo $name; ?>!"];
            let index = 0;

            function changeHeadline() {
                const headlineElement = document.getElementById("headline");
                headlineElement.style.opacity = 0;
                setTimeout(function() {
                    headlineElement.innerHTML = headlines[index];
                    headlineElement.style.opacity = 1;
                    index = (index + 1) % headlines.length;
                }, 500); // wait for fade out transition to complete before changing text and fading in
            }

            setInterval(changeHeadline, 3000);
        </script>

        <div class="profile_buttons">
            <a href="../Search/search_page.php" class="btn btn-primary btn-lg outer" style="margin-right: 5%; width: 200px">Search</a>
            <a href="update_profile.php" class="btn btn-light btn-lg outer2" style="margin-left: 5%; width: 200px">Update Profile</a>
        </div>

        <!-- Start of Page Here-->
        <div class="table" style="margin: auto; margin-top: 3%; text-align: center">
            <div class="row" style="width: 80%; margin: auto; text-align: center">
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Name</h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Username</h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Education</h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Location</h3></div>
            </div>
            <div class="row" style="width: 80%; margin: auto; text-align: center">
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $name ?></h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $username ?></h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $education ?></h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $mylocation ?></h3></div>
            </div>

            <hr>
            
            <div class="row" style="width: 80%; margin: auto; text-align: center">
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Experience</h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Skills</h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Availability</h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 2vw">Languages</h3></div>
            </div>
            <div class="row" style="width: 80%; margin: auto; text-align: center">
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $experience ?></h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $skills ?></h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $availability ?></h3></div>
                <div class="cell" style="width: 25%"><h3 class="text-white" style="font-size: 1.2vw"><?php echo $languages ?></h3></div>
            </div>

            <hr>
            
            <?php include 'BACK_display_pdf.php' ?>
            <hr>
        </div>
    </body>
</html>