

<?php
//declare(strict_types=1);
require_once 'vendor/autoload.php';
//require "webpages/Search/BACK_apply.php";

use PHPUnit\Framework\TestCase;

class StudentApplicationTest extends TestCase
{
    public function testSuccessApp()
    {
        //student log-in
        $_SESSION['username'] = 'Anna';

        //connect to database 
        $conn = new mysqli("localhost", "root", DB_PASSWORD, "application");
        //makes sure no other applications (clears)
        $conn->query("DELETE FROM applications");

        //submitting an application
        $postingid = 321;
        $form = array('id', $postingid);
        $applicationResponse = $this->post('/BACK_apply.php', $form);

        //make sure that the response to the application leads to the succes page
        $this->assertEquals(302, $applicationResponse->getStatusCode());
        //retrieve header of location 
        $this->assertEquals('/success_apply_position.php', $applicationResponse->getHeaderLine('Location'));

        //check if application is saved in database
        $result = $conn->query("SELECT * FROM applications WHERE postingid = $postingid AND student = 'Anna'");

        $this->assertEquals(1, $result->num_rows);

        $this->clear();

    }

    //cleanup - clear at the end of testing



    public function clear(): void
    {
        // Set up the database connection
        $conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");

        // Delete any rows that were inserted during the test
        $conn->query("DELETE FROM applications");

        // Close the database connection
        $conn->close();
    }


}

?>
