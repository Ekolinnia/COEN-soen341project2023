<?php include '../../DB_PASSWORD.php' ?>
<?php
// Start the session to store any error messages
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if the form has been submitted
if (isset($_POST['create_posting'])) {
    // Get the form data
    $company = $_POST['company'];
    $industry = $_POST['industry'];
    $info = $_POST['info'];
    $plocation = $_POST['location'];
    $position = $_POST['position_title'];
    $salary = $_POST['salary'];

    // Validate the form data
    if (empty($salary) || empty($position) || empty($plocation) || empty($info) || empty($industry) || empty($company)) {
        $_SESSION['error'] = "All fields are required";
    } else {
        // Check if the position already exists
        $conn = mysqli_connect('localhost', 'root', DB_PASSWORD, 'postings');
        $query = "SELECT * FROM postings WHERE position='$position'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Posting already exists.";
        } else {
            // Get the highest id number used by another posting
            $query = "SELECT MAX(id) AS max_id FROM postings";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $next_id = $row['max_id'] + 1;

            // Insert the data into the database with the next id number
            $query = "INSERT INTO postings (id, company, industry, info, plocation, position, salary) VALUES ('$next_id', '$company', '$industry', '$info', '$plocation', '$position', '$salary')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['success'] = "Posting created successfully.";
                header("Location: success_post.php");
                exit;
            } else {
                $_SESSION['error'] = "Error: " . mysqli_error($conn);
            }
        }

        // Close the database connection
        mysqli_close($conn);
    }

    // Redirect back to the form page
    header("Location: error_post.php");
    exit;
}
?>
