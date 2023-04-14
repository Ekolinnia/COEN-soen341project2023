<?php include '../../DB_PASSWORD.php' ?>
<?php include '../Homepage/BACK_timeout.php' ?>


<?php

// Connect to the database
$mysqli = new mysqli("localhost", "root", DB_PASSWORD, "users");

// Retrieve the user's name from the database
$username = $_SESSION['username'];
$query = "SELECT usertype, company, location, industry FROM users WHERE username = '$username'";
$result = $mysqli->query($query);

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../SignUp/sign_up_page.php");
    exit;
} else {
    $row = $result->fetch_assoc();
    $usertype = $row['usertype'];
    if ($usertype == 'employee') {
        header("Location: ../SignUp/sign_up_page.php");
        exit;
    }
    if(!isset($row['company']) || !isset($row['location']) || !isset($row['industry'])){
        $missing = "Location: error_post.php?a=a";
        if(!isset($row['company'])){
            $missing = $missing . "&comp=1";
        }
        if(!isset($row['location'])){
            $missing = $missing . "&loc=1";
        }
        if(!isset($row['industry'])){
            $missing = $missing . "&ind=1";
        }
        header($missing);
        exit;
    }

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

    <div class="sign-up">
        <div style="text-align: center; padding-top: 3%;">
            <h1 class="text-white" style="font-size: 4vw;">
                Create Posting
            </h1>
            <h3 class="text-white" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;">
            Please enter important details below
            </h3>
        </div>

        <div class="container" style="padding-top: 1%">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 class="text-white sign-up-text" style="padding-top: 2%;">Posting</h1>

                    <form class="form-signupq" action="BACK_update_posting.php" method="post" style="background-color: white; padding: 20px; border-radius: 10px; margin-bottom: 50px">
                        <div class="form-group">
                            <label for="position_title">Position Title</label>
                            <input type="text" class="form-control" id="position_title" name="position_title" placeholder="Position Title">
                        </div>
                
                        <div class="form-group">
                            <label for="company">Company</label>
                            <div type="text" style="font-size: 1.1vw; padding-left:2%"><?php echo $row['company'];?></div>
                            <input type="hidden" id="company" name="company" value="<?php echo $row['company'];?>">
                        </div>

                        <div class="form-group">
                            <label for="info">Info</label>
                            <textarea style="height: 200px" class="form-control" id="info" name="info" aria-describedby="info" placeholder="Positon Description"></textarea>
                        </div>
                
                        <div class="form-group">
                            <label for="industry">Industry</label>
                            <div type="text" style="font-size: 1.1vw; padding-left:2%"><?php echo $row['industry'];?></div>
                            <input type="hidden" id="industry" name="industry" value="<?php echo $row['industry'];?>">
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <div type="text" style="font-size: 1.1vw; padding-left:2%"><?php echo $row['location'];?></div>
                            <input type="hidden" id="location" name="location" value="<?php echo $row['company'];?>">
                        </div>

                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary">
                        </div>
                        <button type="submit" name="create_posting" class="btn btn-primary btn-submit outer">Create Posting</button>
                    </form>                                                
                </div>
            </div>
        </div>
    </div>
</body>
</html>