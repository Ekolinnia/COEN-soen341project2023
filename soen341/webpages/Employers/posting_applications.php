<?php include '../../DB_PASSWORD.php' ?>
<?php include '../Homepage/BACK_timeout.php'?>

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
        
        <?php

            // Create connection
            $conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");
            $conn2 = new mysqli("localhost", "root", DB_PASSWORD, "postings");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if ($conn2->connect_error) {
                die("Connection failed: " . $conn2->connect_error);
            }

            if (isset($_GET["id"])) {
                $query1 = "SELECT * FROM applications WHERE postingid=" . urldecode($_GET["id"]);
                $query2 = "SELECT position FROM postings WHERE id=" . urldecode($_GET["id"]);
            }
            else{
                echo '<div class="d-flex flex-column align-items-center" style="margin-top: 2%">';
                echo '<h1 class="text-white text-center" style="font-size: 2vw; margin-top: 10%">Error, missing Posting ID</h1>';
                echo '</div>';
                die();
            }

            $result = $conn->query($query1);

            $posting = $conn2->query($query2);
            $postingname = $posting->fetch_assoc()['position'];

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // Output the rows in the desired format
            ?>
                <div class="table table-hover" style="margin: auto; margin-top: 1%; text-align: center;">
                    <div class="cell" style="width: 15%"><a href="employer_postings.php" class="btn btn-light btn-lg outer2" style="background-color: #ffffff; margin-left: 2%; margin-top: 2%; width: 80%">Back to Postings</a></div>
                    <h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%"><?php echo $postingname?> Applications</h1>
                </div>

                <div style="background-color: white; height: 60%; margin: auto; width: 75%; overflow: scroll; text-align: center">
                    <div class="table" style="margin: auto;">
                        <div class="row header-row" style="position: sticky; top: 0; background-color: #333; z-index: 1; width: auto; margin: auto;">
                            <div class="cell" style="width: 50%"><h3 class="text-white postings-size" style="font-size: 1.5em">Application ID</h3></div>
                            <div class="cell" style="width: 50%"><h3 class="text-white postings-size" style="font-size: 1.5em">Applicant</h3></div>
                        </div>
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">';
                    echo '<a href="posting_applicant.php?appid=' . $row['app_id'] . '&usr=' . $row['student'] . '" style="display: contents">';
                    echo '<div class="cell" style="width: 50%"><h3 class=" postings-size">' . $row['app_id'] . '</h3></div>';
                    echo '<div class="cell" style="width: 50%"><h3 class=" postings-size">' . $row['student'] . '</h3></div>';
                    echo '</a>';
                    echo '</div>';                    
                }
            ?>
                    </div>
                </div>
            <?php
            }
            else {
            ?>    
            <div class="d-flex flex-column align-items-center" style="margin-top: 2%">'
                <h1 class="text-white text-center" style="font-size: 2vw; margin-top: 9%">There are currently no applicants for the position of</h1>
                <h3 class="text-white" style="font-size: 1.5vw; font-family: 'Lato', sans-serif; font-weight: 400;"><?php echo $postingname ?></h3>
                <a href="employer_postings.php" class="btn btn-primary btn-lg outer" style="margin: auto; margin-top: 1%; width: 25%">Return to Postings</a>
            </div>
            <?php
            }

            $conn->close();
            $conn2->close();
        ?>

    </body>
</html>