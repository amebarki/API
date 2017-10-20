<?php

$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/gamers/list', 'App\Gamers\Controller\IndexController::listAction')->bind('gamers.list');

$app->get('/gamers/display/{id}','App\Gamers\Controller\IndexController::displayAction')->bind('gamers.display');

$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/gamers/edit/{id}', 'App\Gamers\Controller\IndexController::editAction')->bind('gamers.edit');

$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->get('/gamers/new', 'App\Gamers\Controller\IndexController::newAction')->bind('gamers.new');

$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/gamers/delete/{id}', 'App\Gamers\Controller\IndexController::deleteAction')->bind('gamers.delete');

$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');
$app->post('/gamers/save', 'App\Gamers\Controller\IndexController::saveAction')->bind('gamers.save');

$app->get('/gamers/response/','App\Gamers\Controller\IndexController::responseAction')->bind('gamers.response');
