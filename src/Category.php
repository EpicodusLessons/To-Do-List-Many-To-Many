<?php  

    class Category
    {
        private $name;

        function __construct($initial_name)
        {
            $this->name = $initial_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }
    }


?>