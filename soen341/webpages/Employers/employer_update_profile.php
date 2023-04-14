<?php include '../Homepage/BACK_timeout.php' ?>
<!-- <?php include '../Students/BACK_store_pdf.php' ?> -->

<?php
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../SignUp/sign_up_page.php");
    exit;
}
?>

<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", DB_PASSWORD, "users");

// Retrieve the user's name from the database
$username = $_SESSION['username'];
$query = "SELECT name, username, company, location, industry FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the query result and get the name value
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $company = $row['company'];
    $location = $row['location'];
    $industry = $row['industry'];
    
} else {
    // Display an error message if the query failed
    $name = "Error: " . $mysqli->error;
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
            <h1 class="text-white" style="font-size: 3vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                Current Profile
            </h1>
        </div>

        <div class="table" style="margin: auto; margin-top: 1%; text-align: center">
            <div class="row" style="width: 1500px; margin: auto; text-align: center">
                <div class="cell" style="width: 300px"><h3 class="text-white" style="font-size: 1.5em">Name</h3></div>
                <div class="cell" style="width: 300px"><h3 class="text-white" style="font-size: 1.5em">Username</h3></div>
                <div class="cell" style="width: 300px"><h3 class="text-white" style="font-size: 1.5em">Company Name</h3></div>
                <div class="cell" style="width: 300px"><h3 class="text-white" style="font-size: 1.5em">Industry</h3></div>
                <div class="cell" style="width: 300px"><h3 class="text-white" style="font-size: 1.5em">Location</h3></div>
                
            </div>
            <div class="row" style="width: 1500px; margin: auto; text-align: center">
                <div class="cell" style="width: 300px"><p class="text-white"><?php echo $name ?></p></div>
                <div class="cell" style="width: 300px"><p class="text-white"><?php echo $username ?></p></div>
                <div class="cell" style="width: 300px"><p class="text-white"><?php echo $company ?></p></div>
                <div class="cell" style="width: 300px"><p class="text-white"><?php echo $industry ?></p></div>
                <div class="cell" style="width: 300px"><p class="text-white"><?php echo $location ?></p></div>
                
            </div>



            <button type="button" style="margin-top: 1%" class="btn btn-primary" id="edit-profile-button">Edit Profile</button>
        </div>

        <script>
		document.getElementById("edit-profile-button").addEventListener("click", function() {
			document.getElementById("edit-profile-form").classList.toggle("d-none");
            document.getElementById("edit-profile-button").classList.toggle("d-none");
		});
	    </script>


        <script>
        document.getElementById("save-button").addEventListener("click", function() {
            document.getElementById("edit-profile-form").classList.toggle("d-none")
        });
        </script>


        <div class="container d-none" id="edit-profile-form" style="padding-top: 1%">
            <div class="col-md-6 offset-md-3" style="margin-top: 2%">
                <form class="form-signupq" action="BACK_update_profile.php" method="post" style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 50px">
                    <div class="form-group">
                        <label for="name">Update Name</label>
                        <input type="" class="form-control" id="name" name="newname" placeholder="Name">
                    </div>
            
                    <div class="form-group">
                        <label for="username">Update Username</label>
                        <input type="" class="form-control" id="username" name="newusername" aria-describedby="username" placeholder="Username">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="username">Update Company Name</label>
                        <input type="" class="form-control" id="company" name="company" aria-describedby="education" placeholder="Company name">
                    </div>

                    <div class="form-group">
                        <label for="username">Update Industry</label>
                        <input type="" class="form-control" id="industry" name="industry" aria-describedby="location" placeholder="Industry">
                    </div>

                    <div class="form-group">
                        <label for="username">Update Location</label>
                        <input type="" class="form-control" id="location" name="location" aria-describedby="experience" placeholder="Location">
                    </div>

                    <hr>
            
                    <div class="form-group">
                        <label for="password1">Update Password</label>
                        <input type="password" class="form-control" id="password1" name="newpassword1" placeholder="Password">
                    </div>
            
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" name="newpassword2" placeholder="Confirm Password">
                    </div>
                    <button type="submit" id="save-button" class="btn btn-primary btn-submit">Save</button>
                </form>
            </div>
            <hr>
        </div>
    </body>
</html>