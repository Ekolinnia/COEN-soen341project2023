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

        <div class="table table-hover" style="margin: auto; margin-top: 1%; text-align: center;">
            <div class="cell" style="width: 15%"><a href="employer_postings.php" class="btn btn-light btn-lg outer2" style="background-color: #ffffff; margin-left: 2%; margin-top: 2%; margin-bottom: 5%; width: 80%">Back to Postings</a></div>
            <div style="text-align: center; margin-top: 9%; margin-bottom: auto;">
                <h3 class="text-white" style="font-size: 2vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                    Applicant has already been selected for an interview
                </h3>
            </div>
        </div>
    </body>
</html>