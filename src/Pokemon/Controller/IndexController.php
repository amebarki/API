<?php

namespace App\Pokemon\Controller;

use Doctrine\DBAL\Platforms\Keywords\ReservedKeywordsValidator;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{

    // Service

    public function idAction(Request $request, Application $app)
    {
        $params = $request->attributes->all();
        return $app['service.pokemon']->getById($params['id']);
    }

    public function receiveAction(Request $request, Application $app)
    {
        $params = $request->request->all();

        return $app['service.pokemon']->receive($params);
    }

    public function generationAction(Request $request, Application $app)
    {
        $params = $request->attributes->all();
        return $app['service.pokemon']->getByGeneration($params['id']);
    }

    public function allPokemonAction(Request $request, Application $app)
    {
        return $app['service.pokemon']->getAllPokemon();
    }

    public function allTypesAction(Request $request, Application $app)
    {
        return $app['service.pokemon']->getAllTypes();
    }

    public function evolutionChainAction(Request $request, Application $app)
    {
        $params = $request->attributes->all();
        return $app['service.pokemon']->getEvolutionChain($params['id']);
    }



    // Repository
    public function listAction(Request $request, Application $app)
    {
        return  $app['repository.pokemon']->getAll();;
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        return $app['repository.pokemon']->delete($parameters['id']);
    }

    public function getIdAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        return $app['repository.pokemon']->getById($parameters['id']);
    }

    public function newAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        return $app['repository.pokemon']->insert($parameters);
    }
}