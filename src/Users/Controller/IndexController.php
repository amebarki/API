<?php

namespace App\Users\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{

    // Repository
    public function listAction(Request $request, Application $app)
    {
        return $app['repository.user']->getAll();;
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();

        return $app['repository.user']->delete($parameters['email']);;
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        return $app['repository.user']->getByEmail($parameters['email']);;
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $user = $app['repository.user']->update($parameters);
        } else {
            $user = $app['repository.user']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('users.list'));
    }

    public function newAction(Request $request, Application $app)
    {
		var_dump($request);
        $parameters = $request->request->all();
        return $app['repository.user']->insert($parameters);
    }

    public function getEmailAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        return $app['repository.user']->getByEmail($parameters['email']);
    }
    public function getFacebookIdAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        return $app['repository.user']->getUserIdByFacebook($parameters['id']);
    }

    public function getGoogleIdAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        return $app['repository.user']->getUserIdByGoogle($parameters['id']);
    }


    public function getShareAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        return      $app['repository.user']->sharePokemon($parameters);

    }

    public  function getOfferAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        return $app['repository.user']->insertOfferPokemon($parameters);
    }

    public function getListOfferAction(Request $request, Application $app){
        return $app['repository.user']->getListOffer();
    }

    public function getlistPokemonAction(Request $request,Application $app){
        $parameters = $request->attributes->all();
        return $app['repository.user']->getListPokemon($parameters['email']);
    }

    public function getAcceptAction(Request $request, Application $app){
        $parameters = $request->request->all();
        return $app['repository.user']->acceptSharePokemon($parameters);
    }

}
