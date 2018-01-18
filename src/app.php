<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use GuzzleHttp\Client;

$app = new Application();

// Ajout des fournisseurs de services
$app->register(new DoctrineServiceProvider());


//Ajout des repositorys
$app['repository.user'] = function ($app) {
    return new App\Users\Repository\UserRepository($app['db']);
};


$app['repository.pokemon'] = function ($app) {
    return new App\Pokemon\Repository\PokemonRepository($app['db']);
};


// Ajout des services

$app['service.pokemon'] = function () {
    return new App\Pokemon\Service\PokemonService(new Client());
};

