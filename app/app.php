<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";
    require_once __DIR__."/../src/Category.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=to_do');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    //get
    //READ (all) tasks
    $app->get("/tasks", function() use ($app) {
        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    //READ (all) categories
    $app->get("/categories", function() use ($app) {
        return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    //post
    //CREATE task
    //to get here, send form from tasks.html.twig. shown with get /tasks.
    $app->post("/tasks", function() use ($app) {
        $description = $_POST['description'];
        $task = new Task($description);
        $task->save();
        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    //CREATE category
    $app->post("/categories", function() use ($app) {
        $name = $_POST['name'];
        $category = new Category($name);
        $category->save();
        return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
    });

    //delete
    //DELETE (all) tasks, then route back to root.
    //present form on the tasks.html.twig page
    $app->delete("/delete_tasks", function() use ($app){
        Task::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    //DELETE (all) categories, then route back to root.
    //present form on the categories.html.twig page
    $app->delete("/delete_categories", function() use ($app){
        Category::deleteAll();
        return $app['twig']->render('index.html.twig');
    });


    return $app;

?>