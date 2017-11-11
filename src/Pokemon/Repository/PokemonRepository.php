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
        $json_source = $res->getBody()->getContents();

        $json_data = json_decode($json_source, true);
        $var = $json_data['forms']['0']['name'];
        $json_tmp = array('name' => $var);

        return new Response(
            json_encode($json_tmp),
            $res->getStatusCode(),
            ['Content-type'=>'application/json']
        );
// voila pour les explications a vous de jouer ;)

    }

    public function receive() {
        $number = json_encode(array('lucky_number'=>mt_rand(0, 100)));
        return new Response(
            $number,
            200,
            ['Content-type'=>'application/json']
        );
    }

}

