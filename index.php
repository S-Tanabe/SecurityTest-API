<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function(Slim\Http\Request $req, Slim\Http\Response $res, $args = [])
{
    return $res->withStatus(400)->write('Bad Request');
});

$app->get('/list', function(Slim\Http\Request $req, Slim\Http\Response $res, $args = [])
{
    return $res->withStatus(200)->write('hogehoge');
});

$app->run();
