<?php include '../../DB_PASSWORD.php' ?>
<?php
if (isset($_POST['id']) || isset($_POST['position']) || isset($_POST['company']) || isset($_POST['industry']) || isset($_POST['plocation'])) {

    // Retrieve data from form
    $id = $_POST['id'];
    $position = $_POST['position'];
    $company = $_POST['company'];
    $industry = $_POST['industry'];
    $plocation = $_POST['plocation'];

    // Connect to the MySQL database
    $mysqli = new mysqli("localhost", "root", DB_PASSWORD, "postings");

    // Construct the MySQL query
    $query = "SELECT * FROM postings WHERE 1=1";

    if (!empty($id)) {
        $query .= " AND id = '$id'";
    }

    if (!empty($position)) {
        $query .= " AND position = '$position'";
    }

    if (!empty($company)) {
        $query .= " AND company = '$company'";
    }

    if (!empty($industry)) {
        $query .= " AND industry = '$industry'";
    }

    if (!empty($plocation)) {
        $query .= " AND plocation = '$plocation'";
    }

    // Build the query string parameter
    $query_string = http_build_query(array('query' => $query));

    // Redirect to search_page.php with the query string parameter
    header("Location: ../Search/search_page.php?" . $query_string);
    exit;
}
?>
