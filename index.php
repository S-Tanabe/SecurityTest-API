<?php
require 'vendor/autoload.php';

$app = new \Slim\App();
$app->response->headers->set('Content-Type', 'application/json');

$db = new PDO('sqlite:security.db');
$db->exec('CREATE TABLE IF NOT EXISTS problems(id INTEGER PRIMARY KEY, contents TEXT)');

$app->get('/', function(Slim\Http\Request $req, Slim\Http\Response $res, $args = [])
{
    return $res->withStatus(400)->write('Bad Request');
});

$app->get('/problems', function(Slim\Http\Request $req, Slim\Http\Response $res, $args = [])
{
    $problems = $db->query('SELECT id, contents FROM problems ORDER BY ID DESC')->fetchAll(PDO::FETCH_ASSOC);
    return $res->withStatus(200)->write(json_encode($problems));
});

$app->run();
