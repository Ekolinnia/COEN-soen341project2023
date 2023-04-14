<?php 
declare(strict_types=1);
//include '../../DB_PASSWORD.php' ?>

<?php

require_once 'vendor/autoload.php';
//require "webpages/Search/search_page.php";

use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    private function clickButton($buttonSelector)
    {
        // simulate a click button element using JavaScript
        $this->executeJavaScript("document.querySelector('$buttonSelector').click();");
    }

    private function executeJS($jsCode)
    {
        // execute the specified JavaScript code 
        $this->webDriver->executeScript($jsCode);
    }

    private function getCurrentUrl()
    {
        // get the current URL using WebDriver
        return $this->webDriver->getCurrentURL();
    }

    private function elementDisplayed($elementSelector)
    {
        // check if the specified element is displayed 
        return $this->webDriver->findElement(WebDriverBy::cssSelector($elementSelector))->isDisplayed();
    }


    //verifies that the salary button, location button, and search button
    public function testSalaryBtn()
    {

        //simulate the salary button
        $this->clickButton('#salary-btn');

        //check if the url contains the expected parameters and value
        $this->assertContains('?query=SELECT%20*%20FROM%20postings%20ORDER%20BY%20salary%20DESC', $this->getCurrentUrl());

        $this->clickButton('#salary-btn');
        $this->assertContains('?query=SELECT%20*%20FROM%20postings%20ORDER%20BY%20salary%20ASC', $this->getCurrentUrl());

    }
    public function testLocationBtn()
    {
        // simulate a click on the location button
        $this->clickButton('#location-btn');

        // check that the URL contains the expected parameter and value
        $this->assertContains('?query=SELECT%20*%20FROM%20postings%20ORDER%20BY%20plocation%20ASC', $this->getCurrentUrl());

        $this->clickButton('#location-btn');

        $this->assertContains('?query=SELECT%20*%20FROM%20postings%20ORDER%20BY%20plocation%20DESC', $this->getCurrentUrl());
    }
    public function testSearchBtn()
    {
        // simulate the search button
        $this->clickButton('#search-btn');

        // check that the search form is displayed
        $this->assertTrue($this->isElementDisplayed('.form-container'));

        // simulate a the close button
        $this->clickButton('.closebtn');

        // check the search form is hidden
        $this->assertFalse($this->isElementDisplayed('.form-container'));
    }

    //verify that the search filter form responds correctly

    //case 1: Submitting all empty fields
    public function noFiltersTest()
    {
        $_POST = array();
        include 'BACK_queury.posting.php';
        include 'search_page.php';

        //ensure that it is not redirected to the search page
        if (strpos($_SERVER['REQUEST_URI'], 'search_page.php') !== false) {
            echo "test case failed/ got redirected to search_page.php \n";

        }
    }
    //try with only the position dilter filled
    public function positionFilterTest()
    {
        $_POST = array('position' => 'C Developper');
        include 'BACK_queury.posting.php';
        include 'search_page.php';

        //ensure it is redirected to the search page
        if (strpos($_SERVER['REQUEST_URI'], 'search_page.php') === false) {
            echo "Test case failed Search  did not redirect to search_page.php\n";
        }

    }


}



?>
