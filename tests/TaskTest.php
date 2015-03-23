<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $DB = new PDO('pgsql:host=localhost;dbname=to_do_test');


    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {

        }

        //Initialize a Task with a description and be able to get it back out of the object using getDescription().
        function testGetDescription()
        { 
            //Arrange
            $description = "Do dishes.";
            $test_task = new Task($description);
            //No need to save here because we are communicating with the object only and not the database.

            //Act
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals($description, $result);

        }

        function testSetDescription()
        { //can I change the description in the object with setDescription() after initializing it?
            //Arrange
            $description = "Do dishes.";
            $test_task = new Task($description);
            //No need to save here because we are communicating with the object only and not the database.

            //Act
            $test_task->setDescription("Drink coffee.");
            $result = $test_task->getDescription();

            //Assert
            $this->assertEquals("Drink coffee.", $result);

        }

        //Next, let's add the Id. property to our Task class. Like any other property it needs a getter and setter.
        //Create a Task with the id in the constructor and be able to get the id back out.
        function testGetId()
        {
            //Arrange
            $id = 1;
            $description = "Wash the dog";
            $test_task = new Task($description, $id);

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        //Create a Task with the id in the constructor and be able to change its value, and then get the new id out.
        function testSetId()
        {
            //Arrange
            $id = 1;
            $description = "Wash the dog";
            $test_task = new Task($description, $id);

            //Act
            $test_task->setId(2);

            //Assert
            $result = $test_task->getId();
            $this->assertEquals(2, $result);
        }


        
    }
?>