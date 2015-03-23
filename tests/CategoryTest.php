<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $DB = new PDO('pgsql:host=localhost;dbname=to_do_test');


    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {

        }

        //Initialize a Category with a name and be able to get it back out of the object using getName().
        function test_getName()
        { 
            //Arrange
            $name = "Kitchen chores";
            $test_category = new Category($name);
            //No need to save here because we are communicating with the object only and not the database.

            //Act
            $result = $test_category->getName();

            //Assert
            $this->assertEquals($name, $result);

        }

        function test_setName()
        { //can I change the name in the object with setName() after initializing it?
            //Arrange
            $name = "Kitchen chores";
            $test_category = new Category($name);
            //No need to save here because we are communicating with the object only and not the database.

            //Act
            $test_category->setName("Home chores");
            $result = $test_category->getName();

            //Assert
            $this->assertEquals("Home chores", $result);

        }

    }
?>