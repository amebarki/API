<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use GuzzleHttp\Client;

$app = new Application();

// Ajout des fournisseurs de services
$app->register(new DoctrineServiceProvider());


//Ajout des repository
$app['repository.user'] = function ($app) {
    return new App\Users\Repository\UserRepository($app['db']);
};

$app['repository.pokemon'] = function () {
    return new App\Pokemon\Repository\PokemonRepository(new Client());
};
