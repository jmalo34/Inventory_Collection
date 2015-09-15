<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Collection.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path.' => __DIR__.'/../views'));

    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('collections.html.twig', array('collections' => Collection::getAll()));
    });

    $app->post("/collections", function() use ($app)
    {
        $collection = new Collection($_POST['ticket']);
        $collection->save();
        return $app['twig']->render('create_collection.html.twig', array('newcollection' => $collection));
    });

    $app->post("/delete_collections", function() use ($app)
    {
        Collection::deleteAll();
        return $app['twig']->render('delete_collections.html.twig');
    });

    return $app;
 ?>
