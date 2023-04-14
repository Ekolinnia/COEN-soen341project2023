
<?php session_start();?>

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

        <!-- Start of Page Here-->
        <div>

            <div style="text-align: center; margin-top: 200px; margin-bottom: auto;">

            <?php
            if(isset($_SESSION['error'])){
                ?>
                <h1 class="text-white" style="margin-top: 30px; font-size: 3vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                    Error
                </h1>
                <h2 class="text-white" style="font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                <?php echo $_SESSION['error']?>
                </h2>
                <hr>
                <a href="post.php" class="btn btn-primary btn-lg outer" style="margin: auto; margin-top: 1%; width: 25%"><h1 style="font-size: 2vw">Try Again</h1></a>
            
                <?php
            }
            else{
            ?>
                <h1 class="text-white" style="margin-top: 30px; font-size: 3vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                    You are missing the following information:
                </h1>
                <h2 class="text-white" style="font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                <?php
                    if(isset($_GET['company'])){
                        echo " Company & ";
                    }
                    if(isset($_GET['loc'])){
                        echo " Location & ";
                    }
                    if(isset($_GET['ind'])){
                        echo " Industry ";
                    }
                    ?>
                </h2>
                <hr>
                <h2 class="text-white" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                    You must fill in these parameters before posting a postion
                </h2>
                <a href="employer_update_profile.php" class="btn btn-primary btn-lg outer" style="margin: auto; margin-top: 1%; width: 25%"><h1 style="font-size: 2vw">Edit Profile</h1></a>
            <?php
            }
            ?>
            </div>
    </body>
</html>


