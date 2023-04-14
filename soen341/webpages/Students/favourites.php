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


// Connect to the database
$conn_postings = new mysqli('localhost', 'root', DB_PASSWORD, 'postings');
if ($conn_postings->connect_error) {
    die('Connection failed: ' . $conn_postings->connect_error);
}

// Get the current student ID
$student = $_SESSION['username'];

//Get all the postings for the user
$sql = "SELECT * FROM favourites WHERE student = '$student'";
$result = mysqli_query($conn_postings, $sql);
if($result != null){
    echo "<table>";
        // Output the rows in the desired format
        echo '<div style="display: flex; justify-content: center; margin-top: 2%"><h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%">Favourites</h1></div>';            
        echo '<div style="background-color: white; height: 70%; margin: auto; width: 80%; overflow: scroll; text-align: center">';
        echo '<div class="table" style="margin: auto;">';
        echo '<div class="row header-row" style="position: sticky; top: 0; background-color: #333; z-index: 1; width: auto; margin: auto;">';
        echo '<div class="cell" style="width: 10%"><h3 class="text-white postings-size" style="font-size: 1.5em">Id</h3></div>';
        echo '<div class="cell" style="width: 20%"><h3 class="text-white postings-size" style="font-size: 1.5em">Position</h3></div>';
        echo '<div class="cell" style="width: 20%"><h3 class="text-white postings-size" style="font-size: 1.5em">Company</h3></div>';
        echo '<div class="cell" style="width: 20%"><h3 class="text-white postings-size" style="font-size: 1.5em">Industry</h3></div>';
        echo '<div class="cell" style="width: 20%"><h3 class="text-white postings-size" style="font-size: 1.5em">Location</h3></div>';
        echo '<div class="cell" style="width: 10%"><h3 class="text-white postings-size" style="font-size: 1.5em">Salary</h3></div>';

            
        echo '</div>';
} else {
    echo "No favourited postings yet!";

}
while ($row = mysqli_fetch_assoc($result)){
    // Retrieve all of the job postings the student has applied to

    $job_posting_id = $row['postingid'];
    $query = "SELECT * FROM postings WHERE id = '$job_posting_id'";
    $job_posting_result = mysqli_query($conn_postings, $query);
    $job_posting_row = mysqli_fetch_assoc($job_posting_result);

    echo '<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">';
    echo '<a href="/soen341/webpages/Search/position.php?id=' . $job_posting_row['id'] . '" style="display: contents">';
    echo '<div class="cell" style="width: 10%"><h3 class=" postings-size">' . $job_posting_row['id'] . '</h3></div>';
    echo '<div class="cell" style="width: 20%"><h3 class=" postings-size">' . $job_posting_row['position'] . '</h3></div>';
    echo '<div class="cell" style="width: 20%"><h3 class=" postings-size">' . $job_posting_row['company'] . '</h3></div>';
    echo '<div class="cell" style="width: 20%"><h3 class=" postings-size">' . $job_posting_row['industry'] . '</h3></div>';
    echo '<div class="cell" style="width: 20%"><h3 class=" postings-size">' . $job_posting_row['plocation'] . '</h3></div>';
    echo '<div class="cell" style="width: 10%"><h3 class=" postings-size">' . $job_posting_row['salary'] . '</h3></div>';
    echo '</a>';
    echo '</div>';       
}

        echo "</table>";

// Close the database connection
mysqli_close($conn_postings);

?>

<script>
        // get the button elements
        const salaryBtn = document.querySelector('#salary-btn');
        const locationBtn = document.querySelector('#location-btn');

        // add click event listeners to the buttons
        salaryBtn.addEventListener('click', function() {
            // get the current query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const query = urlParams.get('query');

            // determine the current sort order for salary
            let sortOrder = 'ASC';
            if (query && query.includes('DESC')) {
                sortOrder = 'ORDER BY salary ASC';
            } else {
                sortOrder = 'ORDER BY salary DESC';
            }

            // construct the new query string
            let newQuery = 'SELECT * FROM postings ' + sortOrder;

            // update the query parameter in the URL and reload the page
            urlParams.set('query', newQuery);
            window.location.search = urlParams.toString();
        });

        locationBtn.addEventListener('click', function() {
            // get the current query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const query = urlParams.get('query');

            // determine the current sort order for location
            let sortOrder = 'ASC';
            if (query && query.includes('ASC')) {
                sortOrder = 'ORDER BY plocation DESC';
            }
            else {
                sortOrder = 'ORDER BY plocation ASC';
            }


            // construct the new query string
            let newQuery = 'SELECT * FROM postings ' + sortOrder;

            // update the query parameter in the URL and reload the page
            urlParams.set('query', newQuery);
            window.location.search = urlParams.toString();
        });
    </script>

    <script>
        const searchBtn = document.querySelector("#search-btn");
        searchBtn.addEventListener("click", () => {
        // Create form element for user input
        const searchForm = document.createElement("form");
        searchForm.setAttribute("action", "BACK_query_posting.php");
        searchForm.setAttribute("method", "post");

        // Create input elements for user input
        const idInput = document.createElement("input");
        idInput.setAttribute("type", "text");
        idInput.setAttribute("placeholder", "ID");
        idInput.setAttribute("name", "id");

        const positionInput = document.createElement("input");
        positionInput.setAttribute("type", "text");
        positionInput.setAttribute("placeholder", "Position");
        positionInput.setAttribute("name", "position");

        const companyInput = document.createElement("input");
        companyInput.setAttribute("type", "text");
        companyInput.setAttribute("placeholder", "Company");
        companyInput.setAttribute("name", "company");

        const industryInput = document.createElement("input");
        industryInput.setAttribute("type", "text");
        industryInput.setAttribute("placeholder", "Industry");
        industryInput.setAttribute("name", "industry");

        const locationInput = document.createElement("input");
        locationInput.setAttribute("type", "text");
        locationInput.setAttribute("placeholder", "Location");
        locationInput.setAttribute("name", "plocation");

        // Create a button to submit the form
        const submitBtn = document.createElement("button");
        submitBtn.innerText = "Search";
        submitBtn.classList.add("searchbtn");

        // Create a button to close the form
        const closeBtn = document.createElement("button");
        closeBtn.innerText = "Close";
        closeBtn.classList.add("closebtn");

        // Create a container to hold the form elements and buttons
        const formContainer = document.createElement("div");
        formContainer.classList.add("form-container");
        formContainer.appendChild(idInput);
        formContainer.appendChild(positionInput);
        formContainer.appendChild(companyInput);
        formContainer.appendChild(industryInput);
        formContainer.appendChild(locationInput);
        formContainer.appendChild(submitBtn);
        formContainer.appendChild(closeBtn);

        // Append the form to the container
        searchForm.appendChild(formContainer);

        // Append the container to the page
        document.body.appendChild(searchForm);

        // Add event listener to close button
        closeBtn.addEventListener("click", () => {
            searchForm.remove();
        });
        });
    </script>
</body>
</html>
