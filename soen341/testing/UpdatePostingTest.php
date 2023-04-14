

<?php

require_once 'vendor/autoload.php';
//require "webpages/Employers/BACK_update_posting.php";

use PHPUnit\Framework\TestCase;

class UpdatePostingTest extends TestCase
{
    public function testUpdatePosting()
    {
        $id = 1;
        $originalData = array(

            'company' => 'Name',
            'industry' => 'Industry',
            'info' => 'info',
            'plocation ' => 'location',
            'position' => 'position',
            'salary' => 'Salary'
        );
        $newdata = array(

            'company' => 'New Name',
            'industry' => 'New Industry',
            'info' => 'New info',
            'plocation ' => ' New location',
            'position' => ' New position',
            'salary' => ' New Salary'

        );


        $conn = mysqli_connect('localhost', 'root', DB_PASSWORD, 'postings');
        // Update the posting 
        $query = "UPDATE postings SET company='{$newdata['company']}', industry='{$newdata['industry']}', info='{$newdata['info']}', plocation='{$newdata['plocation']}', position='{$newdata['position']}', salary='{$newdata['salary']}' WHERE id=$id";
        mysqli_query($conn, $query);

        //verify that everything was updated succesfuly
        $this->assertEquals($newdata['company'], 'New Name');
        $this->assertEquals($newdata['industry'], 'New Industry');
        $this->assertEquals($newdata['info'], 'New Info');
        $this->assertEquals($newdata['plocation'], 'New Location');
        $this->assertEquals($newdata['position'], 'New Position');
        $this->assertEquals($newdata['salart'], 'New Salary');

        //clear

        $query = "UPDATE postings SET company='{$originalData['company']}', industry='{$originalData['industry']}', info='{$originalData['info']}', plocation='{$originalData['plocation']}', position='{$originalData['position']}', salary='{$originalData['salary']}' WHERE id=$id";
        mysqli_query($conn, $query);
        mysqli_close($conn);




    }
}


?>
