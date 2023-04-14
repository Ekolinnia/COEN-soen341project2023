<?php include '../Homepage/BACK_timeout.php' ?>
<?php include 'BACK_store_pdf.php' ?>

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
$query = "SELECT name, username, education, mylocation, experience, availability, skills, languages FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row from the query result and get the name value
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $education = $row['education'];
    $mylocation = $row['mylocation'];
    $experience = $row['experience'];
    $availability = $row['availability'];
    $skills = $row['skills'];
    $languages = $row['languages'];
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
            <div class="row" style="width: 1600px; margin: auto; text-align: center">
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Name</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Username</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Education</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Location</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Experience</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Skills</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Availability</h3></div>
                <div class="cell" style="width: 200px"><h3 class="text-white" style="font-size: 1.5em">Languages</h3></div>
            </div>
            <div class="row" style="width: 1600px; margin: auto; text-align: center">
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $name ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $username ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $education ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $mylocation ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $experience ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $skills ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $availability ?></p></div>
                <div class="cell" style="width: 200px"><p class="text-white"><?php echo $languages ?></p></div>
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
                <form class="form-signupq" action="BACK_update_profile_info.php" method="post" style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 50px">
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
                        <label for="username">Update Education</label>
                        <input type="" class="form-control" id="education" name="education" aria-describedby="education" placeholder="Education">
                    </div>

                    <div class="form-group">
                        <label for="username">Update Location</label>
                        <input type="" class="form-control" id="location" name="mylocation" aria-describedby="location" placeholder="Location">
                    </div>

                    <div class="form-group">
                        <label for="username">Update Experience</label>
                        <input type="" class="form-control" id="experience" name="experience" aria-describedby="experience" placeholder="Experience">
                    </div>

                    <div class="form-group">
                        <label for="username">Update Skills</label>
                        <input type="" class="form-control" id="skills" name="skills" aria-describedby="skills" placeholder="JavaScript, Project Manager, Power BI, C++, Python... ">
                    </div>

                    <div class="form-group">
                        <label for="username">Update Availability</label>
                        <input type="" class="form-control" id="availability" name="availability" aria-describedby="availability" placeholder="Full-Time, Part-Time, Student, Internship...">
                    </div>

                    <div class="form-group">
                        <label for="username">Update Languages</label>
                        <input type="" class="form-control" id="languages" name="languages" aria-describedby="languages" placeholder="Languages">
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
            <div style="text-align: center">
                <div style="background-color: white; padding: 40px; width: 60%; margin: auto; border-radius: 10px">
                    <h1 style="color: #333333; font-size: 3vw; font-family: 'Lato', sans-serif; font-weight: 400; margin-top: 0;">Update Resume</h1>
                    <form method="post" enctype="multipart/form-data" style="margin-top: 20px;">
                        <label for="pdf-upload" style="color: #333333; font-size: 1.6vw; font-family: 'Lato', sans-serif; font-weight: 300; display: block;">Choose a PDF file to upload:</label>
                        <div style="position: relative; display: inline-block; margin-top: 10px;">
                            <input type="file" id="pdf-upload" name="pdf" style="position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer;" />
                            <div style="background-color: #0099ff; color: #FFFFFF; font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400; border: none; padding: 10px 20px; border-radius: 5px; display: inline-block; cursor: pointer;">Choose File</div>
                        </div>
                        <button type="submit" name="submit" style="background-color: #0099ff; color: #FFFFFF; font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400; border: none; padding: 10px 20px; border-radius: 5px; margin-top: 20px; cursor: pointer;">Upload</button>
                    </form>
                </div>
            <div>
            <hr>
        </div>
    </body>
</html>