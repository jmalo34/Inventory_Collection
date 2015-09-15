<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Type.php";

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TypeTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Type::deleteAll();
        }

        function test_getDescript()
        {
            //Arrange
            $descript = "Event Keepsakes";
            $test_Type = new Type($descript);

            //Act
            $result = $test_Type->getDescript();

            //Assert
            $this->assertEquals($descript, $result);
        }

        function test_getId()
        {
            //Arrange
            $descript = "Event Keepsakes";
            $id = 1;
            $test_Type = new Type($descript, $id);

            //Act
            $result = $test_Type->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $descript = "Event Keepsakes";
            $test_Type = new Type($descript);
            $test_Type->save();

            //Act
            $result = Type::getAll();

            //Assert
            $this->assertEquals($test_Type, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $descript = "Event Keepsakes";
            $descript2 = "Antiques";
            $test_Type = new Type($descript);
            $test_Type->save();
            $test_Type2 = new Type($descript2);
            $test_Type2->save();

            //Act
            $result = Type::getAll();

            //Assert
            $this->assertEquals([$test_Type, $test_Type2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $descript = "Event Keepsakes";
            $descript2 = "Antiques";
            $test_Type = new Type($descript);
            $test_Type->save();
            $test_Type2 = new Type($descript2);
            $test_Type2->save();

            //Act
            Type::deleteAll();
            $result = Type::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $descript = "Event Keepsakes";
            $descript2 = "Antiques";
            $test_Type = new Type($descript);
            $test_Type->save();
            $test_Type2 = new Type($descript2);
            $test_Type2->save();

            //Act
            $result = Type::find($test_Type->getId());

            //Assert
            $this->assertEquals($test_Type, $result);
        }
    }
 ?>
