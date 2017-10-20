<?php

namespace App\Gamers\Controller;
use GuzzleHttp\Client;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $gamers = $app['repository.gamer']->getAll();

        return $app['twig']->render('gamers.list.html.twig', array('gamers' => $gamers));
    }

	public function displayAction(Request $request, Application $app)
    {

        $parameters = $request->attributes->all();
        $users = $app['repository.gamer']->getAllUsers($parameters['id']);
        var_dump($users);

        die;
        return $app['twig']->render('gamers.display.html.twig', array('users' => $users));
    }


    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.gamer']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('gamers.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $gamer = $app['repository.gamer']->getById($parameters['id']);

        return $app['twig']->render('gamers.form.html.twig', array('gamer' => $gamer));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $gamer = $app['repository.gamer']->update($parameters);
        } else {
            $gamer = $app['repository.gamer']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('gamers.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('gamers.form.html.twig');
    }

    public function responseAction(Request $request, Application $app)
    {
        return $app['repository.gamer']->response();
        
    }

}
