<?php include '../../DB_PASSWORD.php' ?>
<?php

// Start the session to store any error messages
session_start();

// Check if the form has been submitted
if (isset($_POST['company']) ||
    isset($_POST['industry']) || 
    isset($_POST['info']) || 
    isset($_POST['location']) || 
    isset($_POST['position_title']) || 
    isset($_POST['salary']) ||
    isset($_GET['id']) ) {
    // Get the form data
    $company = $_POST['company'];
    $industry = $_POST['industry'];
    $info = $_POST['info'];
    $plocation = $_POST['location'];
    $position = $_POST['position_title'];
    $salary = $_POST['salary'];
    $id = $_GET['id'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', DB_PASSWORD, 'postings');

    // // retrieve posting
    // $sql = "SELECT * FROM postings WHERE id = '$id'";
    // $result = mysqli_query($conn, $sql);
    // $posting = mysqli_fetch_assoc($result);
    
    // Update the name if it has been updated
    if (!empty($salary)) {
        $update_query = "UPDATE postings SET salary='$salary' WHERE id='$id'";
        //mysqli_query($conn, $update_query);
        if (!mysqli_query($conn, $update_query)) {
            echo "Error updating salary: " . mysqli_error($conn);
        }
    }

    // Update the username if it has been updated
    if (!empty($info)) {
        $update_query = "UPDATE postings SET info='$info' WHERE id='$id'";
        //mysqli_query($conn, $update_query);
        if (!mysqli_query($conn, $update_query)) {
            echo "Error updating info: " . mysqli_error($conn);
        }
    }

    // Update the position if it has been updated
    if (!empty($position)) {
        $update_query = "UPDATE postings SET position='$position' WHERE id='$id'";
        //mysqli_query($conn, $update_query);
        if (!mysqli_query($conn, $update_query)) {
            echo "Error updating position: " . mysqli_error($conn);
        }
    }

    // Update the company name if it has been updated
    if (!empty($company)) {
        $update_query = "UPDATE postings SET company='$company' WHERE id='$id'";
        //mysqli_query($conn, $update_query);
        if (!mysqli_query($conn, $update_query)) {
            echo "Error updating company: " . mysqli_error($conn);
        }
        
    }

    // Update the location if it has been updated
    if (!empty($plocation)) {
        $update_query = "UPDATE postings SET plocation='$plocation' WHERE id='$id'";
        //mysqli_query($conn, $update_query);
        if (!mysqli_query($conn, $update_query)) {
            echo "Error updating location: " . mysqli_error($conn);
        }
    }

    // Update the indsutry if it has been updated
    if (!empty($industry)) {
        $update_query = "UPDATE postings SET industry='$industry' WHERE id='$id'";
        //mysqli_query($conn, $update_query);
        if (!mysqli_query($conn, $update_query)) {
            echo "Error updating industry: " . mysqli_error($conn);
        }
    }


    // Close the database connection
    mysqli_close($conn);

    // Redirect to the success page
    $_SESSION['success'] = "Posting updated successfully.";
    header("Location: position_info.php?id=$id");
    exit;
}
?>
