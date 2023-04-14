<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';
//require "webpages/Employers/posting_applicant.php";


use PHPUnit\Framework\TestCase;

class EmployerCandidateSelectionTest extends TestCase
{

    //check if it displays the applicant info
    public function testGetUserInfo()
    {
        //set a test data
        $_GET["usr"] = "student";

        // Set up database connection
        $conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        ob_start();
        include "webpages/Employers/posting_applicant.php";
        $output = ob_get_clean();

        // expected content should be present on the page
        $this->assertContains('<h1 class="text-white">', $output);
        $this->assertContains('<p class="text-white">', $output);
        $this->assertContains('<p class="text-white">', $output);
        $this->assertContains('<p class="text-white">', $output);
        $this->assertContains('<p class="text-white">', $output);
        $this->assertContains('<p class="text-white">', $output);
        $this->assertContains('<p class="text-white">', $output);

        // Check that the query was successful + the correct data was returned
        $this->assertNotContains("Error:", $output);
        $this->assertContains("anna", $output);
        $this->assertContains("Computer", $output);
        $this->assertContains("Montreal", $output);
        $this->assertContains("1 year", $output);
        $this->assertContains("C++", $output);
        $this->assertContains("full-time", $output);
        $this->assertContains("English", $output);

        // Close database connection
        $conn->close();


    }



    //verify that the list of applicant is shown when employer goes to check list of applicants
    public function testAppPage()
    {
        $url = "http://localhost/applicant.php?id=1";
        //initialize url
        $ch = curl_init($url);
        //make sure output returned as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        //look if the page is loaded correctly
        $this->assertEquals(200, $httpCode);

        //verifies that the expected content is on the page
        $this->assertContains('<h1 class="text-white" style="font-size: 4vw; margin-bottom: 1%">', $output);
        $this->assertContains('<h3 class="text-white postings-size" style="font-size: 1.5em">Application ID</h3>', $output);
        $this->assertContains('<h3 class="text-white postings-size" style="font-size: 1.5em">Applicant</h3>', $output);

    }

    public function testSelected()
    {
        //test data
        $_GET["appid"] = 123;

        //connection to database
        $conn = new mysqli("localhost", "root", DB_PASSWORD, "applications");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //  request to the script
        ob_start();
        include "soen341/webpages/Employers/BACK_hire.php";
        $output = ob_get_clean();

        //content present on the page
        $this->assertContains('Column value updated successfully', $output);

        // Check that the query was successful and the correct data was updated
        $sql = "SELECT selected FROM applications WHERE app_id = 123";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $this->assertEquals(1, $row["selected"]);

        // Close database connection
        $conn->close();

    }


}


?>