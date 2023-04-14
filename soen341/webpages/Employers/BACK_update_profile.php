<?php include '../../DB_PASSWORD.php' ?>
<?php

// Start the session to store any error messages
session_start();

// Check if the form has been submitted
if (isset($_POST['newname']) ||
    isset($_POST['newusername']) || 
    isset($_POST['newpassword1']) || 
    isset($_POST['newpassword2']) || 
    isset($_POST['company']) || 
    isset($_POST['industry']) ||
    isset($_POST['location'])) {

    // Get the form data
    $newname = $_POST['newname'];
    $newusername = $_POST['newusername'];
    $newpassword1 = $_POST['newpassword1'];
    $newpassword2 = $_POST['newpassword2'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $industry = $_POST['industry'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', DB_PASSWORD, 'users');

    // Check if the username already exists
    if (!empty($newusername)) {
        $query = "SELECT * FROM users WHERE username='$newusername'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Username already taken.";
            header("Location: ../SignUp/error.php");
            exit;
        }
    }

    // Hash the password if it has been updated
    if (!empty($newpassword1) && ($newpassword1 === $newpassword2)) {
        $hashed_password = password_hash($newpassword1, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password='$hashed_password' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    } elseif (!empty($newpassword1) && ($newpassword1 !== $newpassword2)) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../SignUp/error.php");
        exit;
    }

    // Update the name if it has been updated
    if (!empty($newname)) {
        $update_query = "UPDATE users SET name='$newname' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Update the username if it has been updated
    if (!empty($newusername)) {
        $update_query = "UPDATE users SET username='$newusername' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
        $_SESSION['username'] = $newusername;
    }

    // Update the company name if it has been updated
    if (!empty($company)) {
        $update_query = "UPDATE users SET company='$company' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
        
    }

    // Update the location if it has been updated
    if (!empty($location)) {
        $update_query = "UPDATE users SET location='$location' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }

    // Update the indsutry if it has been updated
    if (!empty($industry)) {
        $update_query = "UPDATE users SET industry='$industry' WHERE username='{$_SESSION['username']}'";
        mysqli_query($conn, $update_query);
    }


    // Close the database connection
    mysqli_close($conn);

    // Redirect to the success page
    $_SESSION['success'] = "Profile updated successfully.";
    header("Location: employer_update_profile.php");
    exit;
}
?>
