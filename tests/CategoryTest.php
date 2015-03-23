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
        function testGetName()
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

        function testSetName()
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

        //Next, let's add the Id property to our Category class. Like any other property it needs a getter and setter.
        //Create a Category with the id in the constructor and be able to get the id back out.
        function testGetId()
        {
            //Arrange
            $id = 1;
            $name = "Kitchen chores";
            $test_category = new Category($name, $id);

            //Act
            $result = $test_category->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        //Create a Category with the id in the constructor and be able to change its value, and then get the new id out.
        function testSetId()
        {
            //Arrange
            $id = 1;
            $name = "Kitchen chores";
            $test_category = new Category($name, $id);

            //Act
            $test_category->setId(2);

            //Assert
            $result = $test_category->getId();
            $this->assertEquals(2, $result);
        }

    }
?>