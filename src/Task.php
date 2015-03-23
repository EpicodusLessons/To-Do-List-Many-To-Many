<?php  

    class Task
    {
        private $description;
        private $id;

        function __construct($initial_description, $initial_id = null)
        {
            $this->description = $initial_description;
            $this->id = $initial_id;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
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