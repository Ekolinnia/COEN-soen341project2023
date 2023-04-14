<?php include 'BACK_timeout.php' ?>

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

    <body class="main-bg">
        <?php include '../Navbar/navbar.php' ?>

        <!-- Start of Page Here-->
        <div style="text-align: center; margin-top: 10%; margin-bottom: 5%;">
            <h1 class="text-white" style="font-size: 5vw; transition: opacity 0.5s ease-out;" id="headline">
                TalentHub
            </h1>
            <h3 class="text-white" style="margin-top: 1%; font-size: 1.4vw; font-family: 'Lato', sans-serif; font-weight: 400;">
                Get that dream job, or make your next big step
            </h3>
        </div>

        <script>
            const headlines = ["Find Opportunities", "Put Yourself Out There", "Hire Qualified Personnel"];
            let index = 0;

            function changeHeadline() {
                const headlineElement = document.getElementById("headline");
                headlineElement.style.opacity = 0;
                setTimeout(function() {
                    headlineElement.innerHTML = headlines[index];
                    headlineElement.style.opacity = 1;
                    index = (index + 1) % headlines.length;
                }, 700); // wait for fade out transition to complete before changing text and fading in
            }

            setInterval(changeHeadline, 5000);
        </script>

        <div class="profile_buttons">
            <a href="../Search/search_page.php" class="btn btn-primary btn-lg outer" style="margin-right: 10%; width: 25%"><h1 style="font-size: 2vw">Search</h1></a>
            <a href="../Employers/post.php" class="btn btn-light btn-lg outer2" style="margin-left: 10%; width: 25%"><h1 style="font-size: 2vw">
                    <?php
                        // Check if the user is logged in
                        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                            $h1_text = "View Profile";
                        }
                        else {
                            if ($_SESSION['usertype'] == 'employee'){
                                $h1_text = "View Profile";
                            }
                            else {
                                $h1_text = "Post Position";
                            }
                        }
                        
                    echo $h1_text; ?>
                    </h1></a>
        </div>

            <div class="text-about" id="about">
                <h3 class="text-black" id="text1" style="font-size: 1.8em; margin-bottom: 4%; margin-top 20%; padding-top: 4%; line-height: 1.5">
                    Welcome to TalentHub, the premier destination for job seekers and employers alike. Our mission is to connect talented professionals with the best job opportunities and help employers find the most qualified candidates for their open positions.
                </h3>
                <h3 class="text-black" id="text2" style="font-size: 1.8em; margin-bottom: 4%; line-height: 1.5">
                    We believe that finding the right job or candidate can be a daunting task, but it doesn't have to be. With TalentHub, job seekers can easily browse and apply for job openings across a wide range of industries and locations. We offer a variety of tools and resources to help job seekers create winning resumes, prepare for interviews, and land their dream job.
                </h3>
                <h3 class="text-black" id="text3" style="font-size: 1.8em; margin-bottom: 4%; line-height: 1.5">
                    For employers, TalentHub provides a streamlined hiring process that saves time and resources. Our platform allows employers to post job openings, search and filter through resumes, and connect with the most promising candidates. We understand that hiring the right person can make all the difference for a business, and we're here to help employers find the talent they need to succeed.
                </h3>
                <h3 class="text-black" id="text4" style="font-size: 1.8em; line-height: 1.5">
                    At TalentHub, we're passionate about helping job seekers and employers achieve their goals. Whether you're looking for a new job or searching for your next hire, we're here to support you every step of the way. Join our community today and discover the many opportunities that await you.
                </h3>
            </div>
    </body>
</html>