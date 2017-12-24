<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

function getPDO()
{
    static $pdo = null;
    if (!is_null($pdo)) {
        return $pdo;
    }

    $pdo = new PDO('sqlite:security.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
}


$app->get('/', function(Slim\Http\Request $req, Slim\Http\Response $res, $args = [])
{
    return $res->withStatus(400)->write('Bad Request');
});

$app->get('/problems', function(Slim\Http\Request $req, Slim\Http\Response $res, $args = [])
{
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT id, title, content, point FROM problems ORDER BY ID DESC");
    $stmt->execute([]);
    $problems = $stmt->fetchAll();
    return $res->withJson($problems, 200, JSON_PRETTY_PRINT);
});

$app->run();
