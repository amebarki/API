<?php

namespace App\Pokemon\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController {

  public function listAction(Request $request, Application $app)
  {
        return $app['repository.pokemon']->getAll();
  }
  public function idAction(Request $request, Application $app)
  {
      $params = $request->attributes->all();
      return $app['repository.pokemon']->getById($params['id']);
  }
}
