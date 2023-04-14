<?php include '../../DB_PASSWORD.php' ?>

<?php

// Start the session to store any error messages
session_start();

if (!isset($_GET['id'])) {
    // id parameter is missing, handle error here
    echo "Error: id parameter is missing";
    exit;
  }
  
// Get the form data
$postingid = $_GET['id'];
$student = $_SESSION['username'];

// Connect to the MySQL database
$conn_postings = new mysqli('localhost', 'root', DB_PASSWORD, 'postings');
if ($conn_postings->connect_error) {
    die('Connection failed: ' . $conn_postings->connect_error);
}

//Check if posting already favourited
$sql_check = "SELECT * FROM favourites WHERE postingid='$postingid' AND student='$student'";
$result_check = $conn_postings->query($sql_check);

if ($result_check->num_rows > 0) {
    // User has already applied, display an error message
    $_SESSION['error'] = "You have already favourited this posting.";
    header("Location: error_fav.php");
    exit();
}

//increment the id every time someone favourites
$query = "SELECT MAX(id) AS max_id FROM favourites";
$result1 = mysqli_query($conn_postings, $query);
$row = mysqli_fetch_assoc($result1);
$next_id = $row['max_id'] + 1;

$sql = "INSERT INTO favourites (id, postingid, student) VALUES ('$next_id', '$postingid', '$student')";
    if ($conn_postings->query($sql) === TRUE) {
        header("Location: success_fav.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


// Close connection
$conn->close();
$conn_postings->close();
?>