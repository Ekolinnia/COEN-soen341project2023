<?php include '../../DB_PASSWORD.php' ?>
<?php
// Retrieve the username and password values from the login form
$username = $_POST['inputusername'];
$password = $_POST['inputpassword'];

// Validate the username and password values
if (empty($username) || empty($password)) {
  // Display an error message and exit the script
  header("Location: error.php?issue=Username%20and%20password%20are%20required");
  exit;
}

// Connect to the MySQL database
$mysqli = new mysqli("localhost", "root", DB_PASSWORD, "users");

// Query the database to retrieve the user's record
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($query);



if ($result->num_rows == 1) {
  // If a record is found, compare the hashed password with the hashed version of the password provided by the user
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    echo "log in successful";
    session_start();

// Set the session timestamp
if (!isset($_SESSION['timestamp'])) {
  $_SESSION['timestamp'] = time();
}

// Set session variables based on the user's role
if ($row['usertype'] == 'employee') {
  $_SESSION['usertype'] = 'employee';
  $_SESSION['username'] = $username;
  $_SESSION['loggedin'] = true;
  // Redirect the user to the student dashboard
  header("Location: ../Students/dashboard.php");
  
  exit;
} else if ($row['usertype'] == 'employer') {
  $_SESSION['usertype'] = 'employer';
  $_SESSION['username'] = $username;
  $_SESSION['loggedin'] = true;
  // Redirect the user to the employer dashboard
  header("Location: ../Employers/employer_dashboard.php");

  exit;

    // If the passwords match, log the user in to your website
    // session_start();

    // // Set the session timestamp
    // if (!isset($_SESSION['timestamp'])) {
    //   $_SESSION['timestamp'] = time();
    // }

    // $_SESSION['username'] = $username;
    // $_SESSION['loggedin'] = true;
    
    // // Redirect the user to the dashboard or home page
    // header("Location: ../Students/dashboard.php");
    // exit;
  }
} }

// If the script reaches this point, the user has provided incorrect login credentials
header("Location: error.php?issue=Invalid%20username%20or%20password");
?>
