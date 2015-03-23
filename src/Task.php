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
            $statement = $GLOBALS['DB']->query("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $new_task = new Task($description, $id);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks *;");
        }

        static function find($search_id)
        {
            $found_task = null;
            $tasks = Task::getAll();
            foreach($tasks as $task) {
                $task_id = $task->getId();
                if ($task_id == $search_id) {
                  $found_task = $task;
                }
            }
            return $found_task;
        }

        function update($new_description)
        {
            $GLOBALS['DB']->exec("UPDATE tasks SET description = '{$new_description}' WHERE id = {$this->getId()};");
            $this->setDescription($new_description);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM tasks WHERE id = {$this->getId()};");
        }

        function addCategory($category)
        {
            return [];
        }

        function getCategories()
        {
            return [];
        }
        
    }

?>