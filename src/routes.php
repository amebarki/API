<?php

$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');



$app->get('/pokemon/list', 'App\Pokemon\Controller\IndexController::listAction')->bind('pokemon.list');
$app->get('/pokemon/receive', 'App\Pokemon\Controller\IndexController::receiveAction')->bind('pokemon.receive');
$app->get('/pokemon/all', 'App\Pokemon\Controller\IndexController::allPokemonAction')->bind('pokemon.all');
$app->get('/pokemon/types', 'App\Pokemon\Controller\IndexController::allTypesAction')->bind('pokemon.types');
$app->get('/pokemon/generation/get/{id}', 'App\Pokemon\Controller\IndexController::generationAction')->bind('pokemon.generation');
$app->get('/pokemon/evolution-chain/get/{id}', 'App\Pokemon\Controller\IndexController::evolutionChainAction')->bind('pokemon.evolutionChain');
$app->get('/pokemon/get/{id}', 'App\Pokemon\Controller\IndexController::idAction')->bind('pokemon.id');

// http://pokecard.api/index.php/pokemon/get/1/parse/type
//http://pokecard.api/index.php/pokemon/get/1/parse/type+compo+name+id