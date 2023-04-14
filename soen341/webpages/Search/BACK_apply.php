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

// check what's being saved
// echo "Posting ID: ";
// var_dump($postingid);
// echo "Student: ";
// var_dump($student);

// Connect to the MySQL database
$conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$conn_postings = new mysqli('localhost', 'root', DB_PASSWORD, 'postings');
if ($conn_postings->connect_error) {
    die('Connection failed: ' . $conn_postings->connect_error);
}

//Check if application already exists
$sql_check = "SELECT * FROM applications WHERE postingid='$postingid' AND student='$student'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // User has already applied, display an error message
    $_SESSION['error'] = "You have already applied to this posting.";
    header("Location: error_application.php");
    exit();
}
// Retrieve the posting id
$sql = "SELECT * FROM postings WHERE id = '$postingid'";
$result = $conn_postings->query($sql);

$query = "SELECT MAX(app_id) AS max_id FROM applications";
$result1 = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result1);
$next_id = $row['max_id'] + 1;

$sql = "INSERT INTO applications (app_id, postingid, student) VALUES ('$next_id', '$postingid', '$student')";
    if ($conn->query($sql) === TRUE) {
        header("Location: success_apply_position.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


// Close connection
$conn->close();
$conn_postings->close();
?>