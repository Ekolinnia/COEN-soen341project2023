

<?php
//declare(strict_types=1);
require_once 'vendor/autoload.php';
//require "webpages/SignUp/BACK_sign_up.php";

use PHPUnit\Framework\TestCase;

class SignUpTest extends TestCase
{

    public function testEmptySignUpForm()
    {
        //nothing in the fields
        $_POST = array();
        //call the rsignup function w the empty field
        $output = $this->SignUp();
        //chrcks for default behavior
        $this->assertContains("All fields are required", $output);
    }

    //stimulate external scenario for a succesful login
    public function testSignUpSuccess()
    {
        //set the values for form
        $_POST = array(
            'name' => 'Test',
            'username' => 'test',
            'password1' => 'password',
            'password2' => 'password',
            'usertype' => 'employer'
        );

        $output = $this->SignUp();
        //everything should work correctly
        $this->assertContains("User registered successfully", $output);
        $this->assertArrayHasKey('success', $_SESSION);
        $this->assertEquals("User registered successfully.", $_SESSION['success']);
        $this->assertArrayHasKey('username', $_SESSION);
        $this->assertEquals("test", $_SESSION['username']);
        $this->assertArrayHasKey('usertype', $_SESSION);
        $this->assertEquals("employer", $_SESSION['usertype']);
        $this->assertTrue($_SESSION['loggedin']);

    }

    //stimulate external scenario for an already existing username account 
    public function testUserExists()
    {
        //user with the same username found in the database
        $conn = mysqli_connect('localhost', 'root', DB_PASSWORD, 'users');
        $query = "INSERT INTO users (usertype, name, username, password) VALUES ('employer', 'Test', 'test', 'password')";
        mysqli_query($conn, $query);

        //test values for the sign up function
        $_POST = array(
            'name' => 'Anna',
            //set the same username found in data base
            'username' => 'test',
            'password1' => 'password',
            'password2' => 'password',
            'usertype' => 'employer'
        );

        $output = $this->SignUp();
        $this->assertContains("Username already taken", $output);
        // Remove the similar test from the database
        $query = "DELETE FROM users WHERE username='test'";
        mysqli_query($conn, $query);
        mysqli_close($conn);

    }

    //if the password doesn't match while creating the account
    public function testNotIdenticalPassword()
    {
        $_POST = array(
            'name' => 'Test',
            'username' => 'test',
            //not similar passwords while confirming
            'password1' => 'password1',
            'password2' => 'password2',
            'usertype' => 'employer'
        );
        $output = $this->SignUp();
        //we expect to output :
        $this->assertContains("Passwords do not match", $output);
    }





    //stimulate the sign up
    private function SignUp()
    {
        ob_start();
        include 'soen341/webpages/SignUp/BACK_sign_up.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

}

?>
