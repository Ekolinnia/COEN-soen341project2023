<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';
//require "webpages/Students/update_profile.php";

use PHPUnit\Framework\TestCase;

class UpdateProfileTest extends TestCase
{

    public function updateProfileTest(): void
    {

        //update the all values

        $_POST['newname'] = 'anna';
        $_POST['newusername'] = 'anna123';
        $_POST['newpassword1'] = 'newpassword';
        $_POST['newpassword2'] = 'newpassword';
        $_POST['education'] = 'Comp Eng';
        $_POST['mylocation'] = 'Montreal';
        $_POST['experience'] = '2 years';
        $_POST['skills'] = 'c++,java';
        $_POST['availability'] = 'Full-time';
        $_POST['languages'] = 'English, French';
        //connection to the data base
        $conn = mysqli_connect('localhost', 'root', DB_PASSWORD, 'users');
        // Ensure connection was successful
        $this->assertInstanceOf(mysqli::class, $conn);

        session_start();

        include 'soen341/webpages/Students/BACK_update_profile_info.php';

        // Check if the profile was updated successfully
        $this->assertStringContainsString('Location: update_profile.php', (string) ob_get_contents());

        // Clean output buffer + close the database connection
        ob_end_clean();
        mysqli_close($conn);
    }



}



?>