<?php

namespace App\Users\Repository;

use App\Pokemon\Service\PokemonService;
use App\Users\Entity\User;
use Doctrine\DBAL\Connection;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * User repository.
 */
class UserRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;


    }

    /**
     * @return Response list of all users
     */
    public function getAll()
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u');

        $statement = $queryBuilder->execute();
        $usersData = $statement->fetchAll();

        foreach ($usersData as $userData) {
            $result[$userData['id']] = ['id' => $userData['id'], 'name' => $userData['name']];
        }
        return new Response(
            \GuzzleHttp\json_encode($result),
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * Returns an User object.
     *
     * @param $id
     *   The id of the user to return.
     *
     * @return Response
     */
    public function getById($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('id = ?')
            ->setParameter(0, $id);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        $user = new User($userData[0]['id'], $userData[0]['name']);


        return new Response(
            $user->toJson(),
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * @param $facebookId of the user
     * @return mixed user_id of the user in the table
     */
    public function getUserIdByFacebook($facebookId){
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('facebook_id = ?')
            ->setParameter(0, $facebookId);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        $user_id = $userData[0]['id'];
        return $user_id;
    }

    /**
     * @param $googleId of the user
     * @return mixed user_id of the user in the table
     */
    public function getUserIdByGoogle($googleId)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('google_id = ?')
            ->setParameter(0, $googleId);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        $user_id = $userData[0]['id'];
        return $user_id;
    }

    /**
     * @param $id of an user
     * @return Response
     */
    public function delete($id)
    {
        // manage erorr here
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('users')
            ->where('id = :id')
            ->setParameter(':id', $id);
        $statement = $queryBuilder->execute();
        return new Response(
            "No erreur",
            200,
            ['Content-type' => 'application/json']
        );
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->update('users')
            ->where('id = :id')
            ->setParameter(':id', $parameters['id']);

        if ($parameters['name']) {
            $queryBuilder
                ->set('name', ':name')
                ->setParameter(':name', $parameters['name']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('users')
            ->values(
                array(
                    'name' => ':name',
                )
            )
            ->setParameter(':name', $parameters['name']);
        $statement = $queryBuilder->execute();
        return new Response(
            \GuzzleHttp\json_encode(array("name" => $parameters['name'])),
            200,
            ['Content-type' => 'application/json']
        );
    }


    /**
     * @param $id of the user
     * @return Response return the list of pokemon of the user
     */
    public function getListPokemon($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('pokemons', 'p')
            ->join('p', 'cardPokemons', 'c', 'c.pokemon_id= p.id')
            ->where('c.user_id = :id')
            ->setParameter(':id', $id);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        return new Response(
            \GuzzleHttp\json_encode($userData),
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * @param $id if the user
     * @return Response return a list of random Pokemon for the user
     */
    public function getBoosterPack($id)
    {
        $client = new Client();
        $pokeService = new PokemonService($client);
        for ($i = 0; $i < 9; $i++) {
            $res = $client->request('GET', 'https://pokeapi.co/api/v2/generation/' . rand(1, 802));
            $json_data = json_decode($res->getBody()->getContents(), true);
            $name_tmp = $json_data['forms']['0']['name'];
            $id_tmp = $json_data['id'];
            if (count($json_data['types']) == 2) {
                $type1_tmp = $json_data['types']['1']['type']['name'];
                $type2_tmp = $json_data['types']['0']['type']['name'];
            } else {
                $type2_tmp = null;
                $type1_tmp = $json_data['types']['0']['type']['name'];
            }

            $sprite_tmp = $json_data['sprites']['front_default'];
            $tmp_desc = $pokeService->getDescById($id_tmp);
        }


    }

    /**
     * Function in charge of the exchange of pokemon
     */


    /**
     * @param $parameters user_id of the user in exchange with pokemon_id of the two pokemon of the exchange
     * @return Response
     */
    public function sharePokemon($parameters)
    {
        //$paramaters['id_user1'] $paramaters['id_user2'] $paramaters['id_pokemon1'] $paramaters['id_pokemon2']

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('cardPokemons')
            ->values(array(
                'user_id' => ':userId',
                'pokemon_id' => ':pokemonId'
            ))
            ->setParameters(array(':userId' => $parameters['user1_id'], ':pokemonID' => $parameters['pokemon2_id']));
        $statement = $queryBuilder->execute();

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('cardPokemons')
            ->values(array(
                'user_id' => ':userId',
                'pokemon_id' => ':pokemonId'
            ))
            ->setParameters(array(':userID' => $parameters['user2_id'], ':pokemonID' => $parameters['pokemon1_id']));
        $statement = $queryBuilder->execute();

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('cardPokemons')
            ->where('user_id = :userId AND pokemon_id = :pokemonId')
            ->setParameters(array(':userId' => $parameters['user1_id'], ':pokemonId' => $parameters['pokemon1_id']));
        $statement = $queryBuilder->execute();


        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('cardPokemons')
            ->where('user_id = :userId AND pokemon_id = :pokemonId')
            ->setParameters(array(':userId' => $parameters['user2_id'], ':pokemonId' => $parameters['pokemon2_id']));
        $statement = $queryBuilder->execute();


        return new Response(
            \GuzzleHttp\json_encode(array("id" => $parameters['pokemon2_id'])),
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * @param $parameters user_id, the id of the pokemon to exchange and the id of the pokemon to want
     */
    public function insertOfferPokemon($parameters)
    {
        // test two id to recup user id
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('exchange')
            ->values(array(
                'user_id' => ':user_id',
                'pokemon_offer_id' => ':pokemon_offer_id',
                'pokemon_wanted_id' => ':pokemon_wanted_id'
            ))
            ->setParameters(array(':user_id' => $parameters['user_id'],
                ':pokemon_offer_id' => $parameters['pokemon_offer_id'],
                ':pokemon_wanted_id' => $parameters['pokemon_wanted_id']));
        $statement = $queryBuilder->execute();
    }

    /**
     * @param $parameters user_id of the user who accept the exchange and the id of theexchange itself, value(accept_offer) to accept the exchange
     */
    public function acceptSharePokemon($parameters)
    {
        // offer_accepted = 1 -> let's go

        // parameters -> id user 2  / id exchange / accept_offer
        // update table exchanges with the id of the exchange accepted
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->update('exchange')
            ->where('id = :exchange_id')
            ->setParameter(':id', $parameters['exchange_id']);

        if ($parameters['accept_offer']) {
            $queryBuilder
                ->set('accept_offer', ':accept_offer')
                ->setParameter(':accept_offer', $parameters['accept_offer']);
        }
        $statement = $queryBuilder->execute();
        $exchangeData = $this->getExchange($parameters['exchange_id']);
        $exchangeData += ["user2_id" => $parameters['user2_id']];
        // proceed exchange pokemons
        $this->sharePokemon($exchangeData);
    }

    /**
     * @param $exchange_id id of the exchange in the table exchange
     * @return mixed return the exchange with this id
     */
    public function getExchange($exchange_id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('e.*')
            ->from('exchanges', 'e')
            ->where('id = ?')
            ->setParameter(0, $exchange_id);
        $statement = $queryBuilder->execute();
        $exchangeData = $statement->fetchAll();
       return $exchangeData[0];

    }

    /**
     * @return Response return the list of exchange of the table exchange
     */
    public function getListOffer()
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('e.*')
            ->from('exchange', 'e');

        $statement = $queryBuilder->execute();
        $exchangesData = $statement->fetchAll();

        foreach ($exchangesData as $exchangeData) {
            $result[$exchangeData['id']] = ['id' => $exchangeData['id'], 'user_id' => $exchangeData['user_id'],
                'pokemon_offer_id' => $exchangeData['pokemon_offer_id'],
                'pokemon_wanted_id' => $exchangeData['pokemon_wanted_id']];
        }
        return new Response(
            \GuzzleHttp\json_encode($result),
            200,
            ['Content-type' => 'application/json']
        );
    }

}
