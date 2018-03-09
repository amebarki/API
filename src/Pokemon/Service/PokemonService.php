<?php

namespace App\Pokemon\Service;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use App\Pokemon\Entity\Pokemon;

/**
 *
 */
class PokemonService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokedex/1/');
        return new Response(
            $res->getBody(),
            $res->getStatusCode(),
            ['Content-type' => 'application/json']
        );
    }

    public function getById($id)
    {

        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/' . $id);
        $json_data = json_decode($res->getBody()->getContents(), true);
        $name = $json_data['forms']['0']['name'];
        $id = $json_data['id'];
        if (count($json_data['types']) == 2) {
            $type1 = $json_data['types']['1']['type']['name'];
            $type2 = $json_data['types']['0']['type']['name'];
        } else {
            $type2 = null;
            $type1 = $json_data['types']['0']['type']['name'];
        }

        $sprite = $json_data['sprites']['front_default'];
        $desc = $this->getDescById($id);
        $pokemon = new Pokemon($id, $name, $type1, $type2, $sprite, $desc);

        // return $pokemon;
        return new Response(
            $pokemon->toJson(),
            $res->getStatusCode(),
            ['Content-type' => 'application/json']
        );
    }

    public function getPokemonById($id)
    {

        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/' . $id);
        $json_data = json_decode($res->getBody()->getContents(), true);
        $name = $json_data['forms']['0']['name'];
        $id = $json_data['id'];
        if (count($json_data['types']) == 2) {
            $type1 = $json_data['types']['1']['type']['name'];
            $type2 = $json_data['types']['0']['type']['name'];
        } else {
            $type2 = null;
            $type1 = $json_data['types']['0']['type']['name'];
        }

        $sprite = $json_data['sprites']['front_default'];
        $desc = $this->getDescById($id);
        $pokemon = new Pokemon($id, $name, $type1, $type2, $sprite, $desc);

        return $pokemon;

    }

    public function getByName($name)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/' . $name);
        $json_data = json_decode($res->getBody()->getContents(), true);
        $name = $json_data['forms']['0']['name'];
        $id = $json_data['id'];
        $type1 = $json_data['types']['1']['type']['name'];
        $type2 = $json_data['types']['0']['type']['name'];
        $sprite = $json_data['sprites']['front_default'];
        $desc = $this->getDescById($name);
        $pokemon = new Pokemon($id, $name, $type1, $type2, $sprite, $desc);
        return new Response(
            $pokemon->toJson(),
            $res->getStatusCode(),
            ['Content-type' => 'application/json']
        );
        return $pokemon;
    }

    public function getDescById($id)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon-species/' . $id);
        $json_data = json_decode($res->getBody()->getContents(), true);
        $name_desc = $json_data['flavor_text_entries']['1']['language']['name'];
        if($name_desc == "ja")
            $desc = $json_data['flavor_text_entries']['2']['flavor_text'];
        else
            $desc = $json_data['flavor_text_entries']['1']['flavor_text'];

        return $desc;
    }

    public function receive($params)
    {
        $number = mt_rand(0, 100);
        $res = \GuzzleHttp\json_encode(array('code' => $params['id'], 'name' => $params['name']));
        return new Response(
            $res,
            200,
            ['Content-type' => 'application/json']
        );
    }

    public function getByGeneration($id)
    {

        $res = $this->client->request('GET', 'https://pokeapi.co/api/v2/generation/' . $id);
        $json_source = json_decode($res->getBody()->getContents(), true);
        $json_data = $json_source['pokemon_species'];
        $result = array();
        $var = 0;
        foreach ($json_data as $item) {
            $tmp = explode("/", $item['url']);
            $i = $tmp[6];
            $result[$var] = ['id' => $i, 'name' => $item['name'],
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $i . '.png'];
            $var++;
        }

        return new Response(
            \GuzzleHttp\json_encode($result),
            $res->getStatusCode(),
            ['Content-type' => 'application/json']
        );
    }

    public function getAllPokemon()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/?limit=802');
        $json_source = json_decode($res->getBody()->getContents(), true);
        $json_data = $json_source['results'];
        $var = 0;
        $result = array();
        foreach ($json_data as $item) {
            $tmp = explode("/", $item['url']);
            $i = $tmp[6];
            $result[$var] = ['id' => $i, 'name' => $item['name'],
                'sprite' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $i . '.png'];
            $var++;
        }

        return new Response(
            \GuzzleHttp\json_encode($result),
            $res->getStatusCode(),
            ['Content-type' => 'application/json']
        );

    }

    public function getAllTypes()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/type/');
        $json_source = json_decode($res->getBody()->getContents(), true);
        $json_data = $json_source['results'];
        $var = 0;
        $types = array();
        foreach ($json_data as $item) {
            $tmp = explode("/", $item['url']);
            $i = $tmp[6];
            $types[$var] = ['id' => $i, 'name' => $item['name']];
            $var++;
        }
        return new Response(
            \GuzzleHttp\json_encode($types),
            $res->getStatusCode(),
            ['Content-type' => 'application/json']
        );
    }

    public function getEvolutionChain($id)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/evolution-chain/' . $id);
        $json_source = json_decode($res->getBody()->getContents(), true);
        $json_data = $json_source['chain'];
        $var = 0;
        $evolution = $this->array_column_recursive($json_data, 'species');
        return new Response(
            \GuzzleHttp\json_encode($evolution),
            $res->getStatusCode(),
            ['Content-type' => 'application/json']
        );
    }

    function array_column_recursive(array $haystack, $needle)
    {
        $found = [];
        array_walk_recursive($haystack, function ($value, $key) use (&$found, $needle) {
            if ($key == $needle)
                $found[] = $value;
        });
        return $found;
    }

    /**
     * @param $id if the user
     * @return Response return a list of random Pokemon for the user
     */
    public function getBoosterPack($email)
    {
        $client = new Client();
        $pokeArray = [];
        for ($i = 0; $i < 5; $i++) {
            $pokemon = $this->getPokemonById(rand(1, 802));
            $pokeArray[$i] = $pokemon;
        }
        return new Response(
            \GuzzleHttp\json_encode($pokeArray),
            200,
            ['Content-type' => 'application/json']
        );
    }
}

