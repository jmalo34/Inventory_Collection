<?php
    class Type
    {
        private $descript;
        private $id;

        function __construct($descript, $id = null)
        {
            $this->descript = $descript;
            $this->id = $id;
        }

        function setDescript($new_descript)
        {
            $this->descript = (string) $new_descript;
        }

        function getDescript()
        {
            return $this->descript;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO types (descript) VALUES ('{$this->getDescript()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_types = $GLOBALS['DB']->query("SELECT * FROM types;");
            $types = array();
            foreach($returned_types as $type)
            {
                $descript = $type['descript'];
                $id = $type['id'];
                $new_type = new Type($descript, $id);
                array_push($types, $new_type);
            }
            return $types;
        }

        static function find($search_id)
        {
            $found_type = null;
            $types = Type::getAll();
            foreach($types as $type)
            {
                $type_id = $type->getId();
                if ($type_id == $search_id)
                {
                    $found_type = $type;
                }
            }
            return $found_type;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM types;");
        }
    }
 ?>
