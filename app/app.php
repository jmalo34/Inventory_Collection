<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Collection.php";
    require_once __DIR__."/../src/Type.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/collections", function() use ($app)
    {
        return $app['twig']->render('collections.html.twig', array('collections' => Collection::getAll()));
    });

    $app->get("/types", function() use ($app)
    {
        return $app['twig']->render('types.html.twig', array('types' => Type::getAll()));
    });

    $app->post("/collections", function() use ($app)
    {
        $collection = new Collection($_POST['thing']);
        $collection->save();
        return $app['twig']->render('collections.html.twig', array('collections' => Collection::getAll()));
    });

    $app->post("/types", function() use ($app)
    {
        $type = new Type($_POST['descript']);
        $type->save();
        return $app['twig']->render('types.html.twig', array('types' => Type::getAll()));
    });

    $app->post("/delete_collections", function() use ($app)
    {
        Collection::deleteAll();
        return $app['twig']->render('delete_collections.html.twig');
    });

    $app->post("/delete_types", function() use ($app)
    {
        Type::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
 ?>
