<?php include '../Homepage/BACK_timeout.php' ?>

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

            <div style="text-align: center; margin-top: 1%; margin-bottom: auto;">
                <h1 class="text-white" style="font-size: 4vw; margin-top: 9%">
                    Success!
                </h1>
                <h3 class="text-white" style="margin-top: 30px; font-size: 1.2vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                    Your account has successfully been created.
                </h3>
                <h3 class="text-white" style="font-size: 1.2vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                    You can now
                </h3>
                <a href="sign_up_page.php" class="btn btn-primary btn-lg outer" style="margin: auto; margin-top: 1%; width: 25%"><h1 style="font-size: 2vw">Log In</h1></a>
            </div>
    </body>
</html>