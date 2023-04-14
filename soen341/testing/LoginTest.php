<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';
//require "webpages/SignUp/BACK_log_in.php";


use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $mysli;

    protected function setUp(): void
    {
        $this->mysqli = new sqli("localhost", "root", DB_PASSWORD, "users");
    }

    public function testForEmptyUserAndPass()
    {
        $postData = [

            //if the inputs are empty
            'inputusername' => '',
            'inputpassword' => '',

        ];

        //we should see this message
        $this->expectExceptionMessage('Username and password are required');
        //will call back the function so user can input again the field
        $this->callLogin($postData);

    }

    public function testForValidUserAndPass()
    {
        $postData = [

            //give a test user and pass
            'inputusername' => 'test_user',
            'inputpassword' => 'test_password',

        ];
        //except this message
        $this->expectOutputString('log in successful');

        $this->callLogin($postData);

        //if the session variables have been set correctly after login
        $this->assertArrayHasKey('timestamp', $_SESSION);
        $this->assertArrayHasKey('username', $_SESSION);
        $this->assertArrayHasKey('loggedin', $_SESSION);
        $this->assertTrue($_SESSION['loggedin']);
    }
    //function of the login form submission
    private function callLogin($postData)
    {
        $_POST = $postData;

        ob_start();
        include 'soen341/webpages/SignUp/BACK_login.php';
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    protected function closeDown(): void
    {
        $this->mysqli->close();
    }
}

?>