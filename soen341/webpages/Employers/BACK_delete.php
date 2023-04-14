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
$conn_app = new mysqli('localhost', 'root', DB_PASSWORD, 'applications');
if ($conn_app->connect_error) {
    die('Connection failed: ' . $conn_app->connect_error);
}

$sql = "DELETE FROM postings WHERE id = '$postingid'";
$sql1 = "DELETE FROM favourites WHERE postingid = '$postingid'";
$query = "DELETE FROM applications WHERE postingid = '$postingid'";

if ($conn_postings->query($sql) === TRUE && $conn_postings->query($sql1) === TRUE && $conn_app->query($query) === TRUE) {
    header("Location: success_delete_post.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn_postings->error;
    echo "Error: " . $sql1 . "<br>" . $conn_postings->error;
    echo "Error: " . $query . "<br>" . $conn_app->error;
}


// Close connection
$conn_postings->close();
$conn_app->close();
?>