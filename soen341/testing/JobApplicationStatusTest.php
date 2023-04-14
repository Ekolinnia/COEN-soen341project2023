<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';
//require "webpages/Students/application_list.php";




use PHPUnit\Framework\TestCase;

//verifies that the student can access all the job he applied too
class JobApplicationStatusTest extends TestCase
{

    public function testApplicationlist()
    {
        // Connection to the database
        $conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");
        $this->assertTrue(!$conn->connect_error, 'Failed to connect to the database');

        //set the current user 
        $_SESSION['usernam'] = 'student';

        //get the list of applications from that user
        $sql = "SELECT * FROM applications WHERE student = 'student'";
        $result = mysqli_query($conn, $sql);
        $this->assertTrue(mysqli_num_rows($result) > 0, 'No applications found for the user');

        //format of the list expected
        ob_start();
        include 'soen341/webpages/Students/applications_list.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<table>', $output, 'Table not found in the output');
        $this->assertStringContainsString('<h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%; margin-left: 38%">Applications</h1>', $output, 'Title not found in the output');
        $this->assertStringContainsString('<div class="table" style="margin: auto;">', $output, 'Table class not found in the output');
        $this->assertStringContainsString('<div class="row header-row" style="position: sticky; top: 0; background-color: #333; z-index: 1; width: auto; margin: auto;">', $output, 'Header row not found in the output');
        $this->assertStringContainsString('<div class="row" style="width: auto; margin: auto; border-bottom: 1px solid #ddd; text-align: center">', $output, 'Data rows not found in the output');

        //Close database connection
        mysqli_close($conn);
        $this->assertTrue(mysqli_ping($conn) === false, 'Failed to close the database connection');



    }

}
?>