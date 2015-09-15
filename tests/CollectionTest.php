<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Collection.php";

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CollectionTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Collection::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $thing = "Run the World";
            $test_collection = new Collection($thing);

            //Act
            $test_collection->save();

            //Assert
            $result = Collection::getAll();
            $this->assertEquals($test_collection, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $thing = "Run the World";
            $thing2 = "20 20 Experience";
            $test_collection = new Collection($thing);
            $test_collection->save();
            $test_collection2 = new Collection($thing2);
            $test_collection2->save();

            //Act
            $result = Collection::getAll();

            //Assert
            $this->assertEquals([$test_collection, $test_collection2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $thing = "Run the World";
            $thing2 = "20 20 Experience";
            $test_collection = new Collection($thing);
            $test_collection->save();
            $test_collection2 = new Collection($thing2);
            $test_collection2->save();

            //Act
            Collection::deleteAll();

            //Assert
            $result = Collection::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            //Arrange
            $thing = "Run the World";
            $id = 1;
            $test_Collection = new Collection($thing, $id);

            //Act
            $result = $test_Collection->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_find()
        {
            //Arrange
            $thing = "Run the World";
            $thing2 = "20 20 Experience";
            $test_collection = new Collection($thing);
            $test_collection->save();
            $test_collection2 = new Collection($thing2);
            $test_collection2->save();

            //Act
            $id = $test_collection->getId();
            $result = Collection::find($id);

            //Assert
            $this->assertEquals($test_collection, $result);
        }
    }
 ?>
