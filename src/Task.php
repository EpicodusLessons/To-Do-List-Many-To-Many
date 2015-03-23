<?php  

    class Task
    {
        private $description;

        function __construct($initial_description)
        {
            $this->description = $initial_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }
        
    }

?>