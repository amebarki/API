<?php

namespace App\Pokemon\Repository;


use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

/**
 *
 */
class PokemonRepository
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll() {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokedex/1/');
        return new Response(
            $res->getBody(),
            $res->getStatusCode(),
            ['Content-type'=>'application/json']
        );
    }

    public function getById($id) {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/'.$id);
        return new Response(
            $res->getBody(),
            $res->getStatusCode(),
            ['Content-type'=>'application/json']
        );
    }
}
