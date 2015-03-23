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
            Category::deleteAll();
            Task::deleteAll();
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


        //CREATE - save method stores all object data in categories table.
        function testSave()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            //Act
            $result = Category::getAll();

            //Assert
            $this->assertEquals($test_category, $result[0]);
        }

        //This test makes sure that after saving not only are the id's equal, they are not null.
        function testSaveSetsId()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);

            //Act
            //save it. Id should be assigned in database, then stored in object.
            $test_category->save();

            //Assert
            //That id in the object should be numeric (not null)
            $this->assertEquals(true, is_numeric($test_category->getId()));
        }

        //READ - All categories
        //This method should return an array of all Category objects from the categories table.
        //Since it isn't specifically for only one Category, it is for all, it should be a static method.
        function testGetAll()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Home stuff";
            $id2 = 2;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();

            //Act
            $result = Category::getAll();

            //Assert
            $this->assertEquals([$test_category, $test_category2], $result);
        }

        //DELETE - All categories
        //Since this also deals with more than one Category it should be a static method.
        function testDeleteAll()
        {
            //Arrange
            //We need some categories saved into the database so that we can make sure our deleteAll method removes them all.
            $name = "Wash the dog";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Water the lawn";
            $id2 = 2;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();

            //Act
            //Delete categories.
            Category::deleteAll();

            //Assert
            //Now when we call getAll, we should get an empty array because we deleted all categories.
            $result = Category::getAll();
            $this->assertEquals([], $result);
        }

        //Test for find category method.
        //Static method to select a category using its id number as input.
        function testFind()
        {
            //Arrange
            //Create and save 2 categories.
            $name = "Wash the dog";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Home stuff";
            $id2 = 2;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();

            //Act
            //search using the id of the first category.
            $result = Category::find($test_category->getId());

            //Assert
            //if the search function works then result should be the first category.
            //ids are unique so this method will always return a single instance. 
            //no need for returning an array like in getAll.
            $this->assertEquals($test_category, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $new_name = "Home stuff";

            //Act
            $test_category->update($new_name);

            //Assert
            $this->assertEquals("Home stuff", $test_category->getName());
        }

        function testDeleteCategory()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();

            $name2 = "Home stuff";
            $id2 = 2;
            $test_category2 = new Category($name2, $id2);
            $test_category2->save();


            //Act
            $test_category->delete();

            //Assert
            $this->assertEquals([$test_category2], Category::getAll());
        }

    }
?>