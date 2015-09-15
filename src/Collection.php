<?php
    class Collection
    {
        private $ticket;
        private $id;

        function __construct($ticket, $id = null)
        {
            $this->ticket = $ticket;
            $this->id = $id;
        }

        function setTicket($new_ticket)
        {
            $this->ticket = (string) $new_ticket;
        }

        function getTicket()
        {
            return $this->ticket;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO collections (ticket) VALUES ('{$this->getTicket()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_collections = $GLOBALS['DB']->query("SELECT * FROM collections;");
            $collections = array();
            foreach($returned_collections as $collection)
            {
                $ticket = $collection['ticket'];
                $id = $collection['id'];
                $new_collection = new Collection($ticket, $id);
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
