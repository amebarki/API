<?php

namespace App\Pokemon\Controller;

use Doctrine\DBAL\Platforms\Keywords\ReservedKeywordsValidator;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{

    public function listAction(Request $request, Application $app)
    {
        return $app['repository.pokemon']->getAll();
    }

    public function idAction(Request $request, Application $app)
    {
        $params = $request->attributes->all();
        return $app['repository.pokemon']->getById($params['id']);
        //return $app['repository.pokemon']->receive();
    }

    public function receiveAction(Request $request, Application $app)
    {
        return $app['repository.pokemon']->receive();
    }

    public function generationAction(Request $request, Application $app)
    {
        $params = $request->attributes->all();
        return $app['repository.pokemon']->getByGeneration($params['id']);
    }


    public function allPokemonAction(Request $request, Application $app)
    {
        return $app['repository.pokemon']->getAllPokemon();
    }

    public function allTypesAction(Request $request, Application $app)
    {
        return $app['repository.pokemon']->getAllTypes();
    }

    public function evolutionChainAction(Request $request, Application $app)
    {
        $params = $request->attributes->all();
        return $app['repository.pokemon']->getEvolutionChain($params['id']);
    }
}