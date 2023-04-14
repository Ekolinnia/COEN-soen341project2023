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

$sql = "DELETE FROM favourites WHERE postingid = '$postingid' AND student = '$student'";
    if ($conn_postings->query($sql) === TRUE) {
        header("Location: success_remove_fav.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


// Close connection
$conn_postings->close();
?>