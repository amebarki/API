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
    public function getByEmail($email)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('email = ?')
            ->setParameter(0, $email);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        if($userData == null)
        {
            return new Response(
                \GuzzleHttp\json_encode(null),
                500,
                ['Content-type' => 'application/json']
            );
        }else
        {
            $user = new User($userData[0]['id'], $userData[0]['name']);
            return new Response(
                $user->toJson(),
                200,
                ['Content-type' => 'application/json']
            );
        }
    }

	
	
	
    public function getById($email)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('email = ?')
            ->setParameter(0, $email);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        return $userData[0]['id'];
    }

 public function getEmailById($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('id = ?')
            ->setParameter(0, $id);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        return $userData[0]['email'];
    }


    /**
     * @param $facebookId of the user
     * @return mixed user_id of the user in the table
     */
    public function getUserIdByFacebook($facebookId)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('u.*')
            ->from('users', 'u')
            ->where('facebook_id = ?')
            ->setParameter(0, $facebookId);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
        $user_id = $userData[0]['id'];
        return new Response(
            $user_id,
            200,
            ['Content-type' => 'application/json']
        );
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
        return new Response(
            $user_id,
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * @param $id of an user
     * @return Response
     */
    public function delete($email)
    {
        // manage erorr here
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('users')
            ->where('email = :email')
            ->setParameter(':email', $email);
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
            ->where('email = :email')
            ->setParameter(':email', $parameters['email']);

        if ($parameters['name']) {
            $queryBuilder
                ->set('name', ':name')
                ->setParameter(':name', $parameters['name']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
		$name =  urldecode($parameters["name"]);
		$email = urldecode($parameters["email"]);
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('users')
            ->values(
                array(
                    'name' => ':name',
                    'email' => ':email'
                )
            )
            ->setParameters(array(':name' => $name, ':email' => $email ));
        $statement = $queryBuilder->execute();
        return new Response(
            \GuzzleHttp\json_encode(array("name" => $name)),
            200,
            ['Content-type' => 'application/json']
        );
    }


    /**
     * @param $id of the user
     * @return Response return the list of pokemon of the user
     */
    public function getListPokemon($email)
    {
        $id = $this->getById($email);
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('pokemons', 'p')
            ->join('p', 'cardPokemons', 'c', 'c.pokemon_id= p.id')
            ->where('c.user_id = :id')
            ->setParameter(':id', $id);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();
		$pokemons = [];
		$i= 0;
		foreach ($userData as $data) {
				$data['type1'] = $this->getTypeName($data['type1']);
				$data['type2'] = $this->getTypeName($data['type2']);
				if($data['type2']== null)
					$data['type2'] = "null";
				if($data['type1']== null)
					$data['type1'] = "null";		
				$pokemons[$i] = ['id' => $data['id'], 'name' => $data['name'],
						'sprite' => $data['sprite'],
						'description' => $data['description'],
						'type1' => $data['type1'],
						'type2' => $data['type2']];
		$i++;
		}
        return new Response(
            \GuzzleHttp\json_encode($pokemons),
            200,
            ['Content-type' => 'application/json']
        );
    }

	
	public function getTypeName($id)
    {
        if($id !=null){
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('types', 'p')
            ->where('id = ?')
            ->setParameter(0, $id);
        $statement = $queryBuilder->execute();
        $typesData = $statement->fetchAll();
        $typeName = $typesData[0]['name'];

        return $typeName;
        }
        else
            return null;
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
        //$paramaters['user1_email'] $paramaters['user2_email'] $paramaters['id_pokemon1'] $paramaters['id_pokemon2']
        // parameters -> email user get user id after
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('cardPokemons')
            ->values(array(
                'user_id' => ':userId',
                'pokemon_id' => ':pokemonId'
            ))
            ->setParameters(array(':userId' => $parameters['user_id'], ':pokemonId' => $parameters['pokemon_wanted_id']));
        $statement = $queryBuilder->execute();

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('cardPokemons')
            ->values(array(
                'user_id' => ':userId',
                'pokemon_id' => ':pokemonId'
            ))
            ->setParameters(array(':userId' =>$parameters['user2_id'], ':pokemonId' => $parameters['pokemon_offer_id']));
        $statement = $queryBuilder->execute();

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('cardPokemons')
            ->where('user_id = :userId AND pokemon_id = :pokemonId')
            ->setParameters(array(':userId' => $parameters['user_id'], ':pokemonId' => $parameters['pokemon_offer_id']));
        $statement = $queryBuilder->execute();


        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('cardPokemons')
            ->where('user_id = :userId AND pokemon_id = :pokemonId')
            ->setParameters(array(':userId' => $parameters['user2_id'], ':pokemonId' => $parameters['pokemon_wanted_id']));
        $statement = $queryBuilder->execute();


        return new Response(
            "Things work hopefully",
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * @param $parameters user_id, the id of the pokemon to exchange and the id of the pokemon to want
     */
    public function insertOfferPokemon($parameters)
    {
        // get user if from mail pass to the parameters
        // test two id to recup user id
        $user_id = $this->getById($parameters['email']);
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('exchanges')
            ->values(array(
                'user_id' => ':user_id',
                'pokemon_offer_id' => ':pokemon_offer_id',
                'pokemon_wanted_id' => ':pokemon_wanted_id',
                'offer_accepted' => ':offer_accepted'
            ))
            ->setParameters(array(':user_id' => $user_id,
                ':pokemon_offer_id' => $parameters['pokemon_offer_id'],
                ':pokemon_wanted_id' => $parameters['pokemon_wanted_id'],
                ':offer_accepted' => $parameters['offer_accepted']));
        $statement = $queryBuilder->execute();
        return new Response(
            "Offer insert hopefully",
            200,
            ['Content-type' => 'application/json']
        );
    }

    /**
     * @param $parameters user_id of the user who accept the exchange and the id of theexchange itself, value(accept_offer) to accept the exchange
     */
    public function acceptSharePokemon($parameters)
    {
        // get mail from parameters and get id from the user 2
        // offer_accepted = 1 -> let's go
        $user2_id = $this->getById($parameters['user2_email']);
        if ($parameters['offer_accepted']) {

            $queryBuilder = $this->db->createQueryBuilder();
            $queryBuilder
                ->update('exchanges')
                ->where('id = :id')
                ->setParameter(':id', $parameters['exchange_id']);
            $queryBuilder
                ->set('offer_accepted', ':offer_accepted')
                ->setParameter(':offer_accepted', $parameters['offer_accepted']);
            $statement = $queryBuilder->execute();
        }
        $exchangeData = $this->getExchange($parameters['exchange_id']);
        $exchangeData += ["user2_id" => $user2_id];
        // proceed exchange pokemons
        $this->sharePokemon($exchangeData);
        return new Response(
            "Exchange accepted hopefully",
            200,
            ['Content-type' => 'application/json']
        );

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
            ->from('exchanges', 'e');

        $statement = $queryBuilder->execute();
        $exchangesData = $statement->fetchAll();
		
        foreach ($exchangesData as $exchangeData) {
			$email = $this->getEmailById($exchangeData['user_id']);
            $result[$exchangeData['id']] = ['id' => $exchangeData['id'], 'email' => $email,
                'pokemon_offer_id' => $exchangeData['pokemon_offer_id'],
                'pokemon_wanted_id' => $exchangeData['pokemon_wanted_id'],
				'offer_accepted' => $exchangeData['offer_accepted']
				];
        }
        return new Response(
            \GuzzleHttp\json_encode($result),
            200,
            ['Content-type' => 'application/json']
        );
    }

}
