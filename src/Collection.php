<?php
    class Collection
    {
        private $thing;
        private $id;

        function __construct($thing, $id = null)
        {
            $this->thing = $thing;
            $this->id = $id;
        }

        function setThing($new_thing)
        {
            $this->thing = (string) $new_thing;
        }

        function getThing()
        {
            return $this->thing;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO collections (thing) VALUES ('{$this->getThing()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_collections = $GLOBALS['DB']->query("SELECT * FROM collections;");
            $collections = array();
            foreach($returned_collections as $collection)
            {
                $thing = $collection['thing'];
                $id = $collection['id'];
                $new_collection = new Collection($thing, $id);
                array_push($collections, $new_collection);
            }
            return $collections;
        }

        static function find($search_id)
        {
            $found_collection = null;
            $collections = Collection::getAll();
            foreach($collections as $collection)
            {
                $collection_id = $collection->getId();
                if ($collection_id == $search_id)
                {
                    $found_collection = $collection;
                }
            }
            return $found_collection;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM collections;");
        }
    }
 ?>
