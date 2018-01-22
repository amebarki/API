<?php

 // Repository Users
$app->get('/local/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/local/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->post('/local/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/local/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/local/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');
$app->get('/local/users/facebook/get/{id}', 'App\Users\Controller\IndexController::getFacebookIdAction')->bind('users.getFacebookId');
$app->get('/local/users/google/get/{id}', 'App\Users\Controller\IndexController::getGoogleIdAction')->bind('users.getGoogleId');
$app->get('/local/users/get/{id}', 'App\Users\Controller\IndexController::getIdAction')->bind('users.getId');
$app->get('local/users/get/{id}/pokemon/list', 'App\Users\Controller\IndexController::getlistPokemonAction')->bind('users.listPokemon');
$app->get('local/users/get/{id}/pokemon/booster', 'App\Pokemon\Controller\IndexController::getBoosterPackAction')->bind('pokemon.booster');

$app->post('local/users/share', 'App\Users\Controller\IndexController::getShareAction')->bind('users.share');
$app->post('local/users/offer','App\Users\Controller\IndexController::getOfferAction')->bind('users.offer');
$app->post('local/users/accept','App\Users\Controller\IndexController::getAcceptAction')->bind('users.accept');

// Service Pokemon
$app->post('/pokemon/receive', 'App\Pokemon\Controller\IndexController::receiveAction')->bind('pokemon.receive');
$app->get('/pokemon/all', 'App\Pokemon\Controller\IndexController::allPokemonAction')->bind('pokemon.all');
$app->get('/pokemon/types', 'App\Pokemon\Controller\IndexController::allTypesAction')->bind('pokemon.types');
$app->get('/pokemon/generation/get/{id}', 'App\Pokemon\Controller\IndexController::generationAction')->bind('pokemon.generation');
$app->get('/pokemon/evolution-chain/get/{id}', 'App\Pokemon\Controller\IndexController::evolutionChainAction')->bind('pokemon.evolutionChain');
$app->get('/pokemon/get/{id}', 'App\Pokemon\Controller\IndexController::idAction')->bind('pokemon.id');
// Repository Pokemon
$app->get('/local/pokemon/list', 'App\Pokemon\Controller\IndexController::listAction')->bind('pokemon.list');
$app->post('/local/pokemon/new', 'App\Pokemon\Controller\IndexController::newAction')->bind('pokemon.new');
$app->get('/local/pokemon/get/{id}', 'App\Pokemon\Controller\IndexController::getIdAction')->bind('pokemon.getId');
$app->post('/local/pokemon/delete/{id}', 'App\Pokemon\Controller\IndexController::deleteAction')->bind('pokemon.delete');


// http://pokecard.api/index.php/pokemon/get/1/parse/type
//http://pokecard.api/index.php/pokemon/get/1/parse/type+compo+name+id