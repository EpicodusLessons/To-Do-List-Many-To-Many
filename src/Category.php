<?php  

    class Category
    {
        private $name;
        private $id;

        function __construct($initial_name, $initial_id = null)
        {
            $this->name = $initial_name;
            $this->id = $initial_id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            return null;
        }

        static function getAll()
        {
            return null;
        }

        static function deleteAll()
        {
            return null;
        }
    }


?>