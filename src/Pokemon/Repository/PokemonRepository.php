<?php

namespace App\Pokemon\Repository;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use App\Pokemon\Entity\Pokemon;
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
        $json_data = json_decode($res->getBody()->getContents(), true);
        $name_tmp = $json_data['forms']['0']['name'];
        $id_tmp = $json_data['id'];
        $type1_tmp = $json_data['types']['1']['type']['name'];
        $type2_tmp = $json_data['types']['0']['type']['name'];
        $sprite_tmp = $json_data['sprites']['front_default'];
        $tmp_desc = $this->getDescById($id);
        $pokemon = new Pokemon($id_tmp,$name_tmp,$type1_tmp,$type2_tmp,$sprite_tmp,$tmp_desc);

       // return $pokemon;
        return new Response(
            $pokemon->toJson(),
            $res->getStatusCode(),
            ['Content-type'=>'application/json']
        );
    }


    public function getByName($name)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/'.$name);
        $json_data = json_decode($res->getBody()->getContents(), true);
        $name_tmp = $json_data['forms']['0']['name'];
        $id_tmp = $json_data['id'];
        $type1_tmp = $json_data['types']['1']['type']['name'];
        $type2_tmp = $json_data['types']['0']['type']['name'];
        $sprite_tmp = $json_data['sprites']['front_default'];
        $tmp_desc = $this->getDescById($name);
        $pokemon = new Pokemon($id_tmp,$name_tmp,$type1_tmp,$type2_tmp,$sprite_tmp,$tmp_desc);
        return new Response(
            $pokemon->toJson(),
            $res->getStatusCode(),
            ['Content-type'=>'application/json']
        );
        return $pokemon;
    }

    public function getDescById($id)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon-species/'.$id);
        $json_data = json_decode($res->getBody()->getContents(), true);
        $desc = $json_data['flavor_text_entries']['1']['flavor_text'];
        return $desc;
    }

    public function receive() {
        $number = json_encode(array('lucky_number'=>mt_rand(0, 100)));
        return new Response(
            $number,
            200,
            ['Content-type'=>'application/json']
        );
    }


    public function getByGeneration($id){
        $client = new Client();
        $res = $client->request('GET', 'https://pokeapi.co/api/v2/generation/'.$id);
        $json_source = json_decode($res->getBody()->getContents(), true);
        $json_data = $json_source['pokemon_species'];
        $var=0;
        $result = array();
        $generation = array();
        foreach($json_data as $item) {
            $tmp = explode("/", $item['url']);
            $i = $tmp[6];
            //$result[$var] = [['id'] => $item['name']];
            $result[$var] = ['id' => $i , 'name' => $item['name']];
            $var++;
        }

        return new Response(
            \GuzzleHttp\json_encode($result),
            $res->getStatusCode(),
            ['Content-type'=>'application/json']
        );
    }

}

