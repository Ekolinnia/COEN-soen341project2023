<?php include '../../DB_PASSWORD.php' ?>

<?php

// connect to database
$conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");

// ensure successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_GET["appid"])){

    //Check if applicant was already hired already exists
    $sql_check = "SELECT selected FROM applications WHERE app_id =" . urldecode($_GET["appid"]);
    $result = $conn->query($sql_check);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $selected = $row['selected'];
        if ($selected != 1) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $sql = "UPDATE applications SET selected = 1 WHERE app_id =" . urldecode($_GET["appid"]);
                if ($conn->query($sql) === TRUE) {
                    echo "Column value updated successfully";
                    header("Location: success_interview.php");
                    exit();
                }
                else {
                    echo "Error updating column value: " . $conn->error;
                }
            }
        }
        else{
            header("Location: error_interview.php?");
            exit();
        }
    }
}

$conn->close();

// Redirect back to dashboard
header("Location: employer_dashboard.php");
exit;
?>