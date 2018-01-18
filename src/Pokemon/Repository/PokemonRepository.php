<?php

namespace App\Pokemon\Repository;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Connection;
use App\Pokemon\Entity\Pokemon;

/**
 *
 */
class PokemonRepository
{
    protected $db;

    public function __construct(Connection $db)

    {
        $this->db = $db;
    }

    public function getAll()
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('pokemons', 'p');

        $statement = $queryBuilder->execute();
        $pokemonsData = $statement->fetchAll();
        $res = array();
        foreach ($pokemonsData as $pokemonData) {
            $poke = new Pokemon($pokemonData['id'], $pokemonData['name'],
                $this->getTypeName($pokemonData['type_one_id']), $this->getTypeName($pokemonData['type_two_id']),
                $pokemonData['sprite'], $pokemonData['description']
            );
            $res[$poke->getId()] = ['id' => $poke->getId(),'name' =>$poke->getName(),
                'description' => $poke->getDescription(),'sprite' =>$poke->getSprite(),
                'type1' => $poke->getType1(),'type2' =>$poke->getType2()];
        }

        return new Response(
             \GuzzleHttp\json_encode($res),
            200,
            ['Content-type' => 'application/json']
        );
    }

    public function getById($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('p.*')
            ->from('pokemons', 'p')
            ->where('id = ?')
            ->setParameter(0, $id);
        $statement = $queryBuilder->execute();
        $pokemonData = $statement->fetchAll();
        $pokemon = new Pokemon($pokemonData[0]['id'], $pokemonData[0]['name'],
            $this->getTypeName($pokemonData[0]['type_one_id']), $this->getTypeName($pokemonData[0]['type_two_id']),
            $pokemonData[0]['sprite'], $pokemonData[0]['description']
        );

        return new Response(
            $pokemon->toJson(),
            200,
            ['Content-type' => 'application/json']
        );
    }


    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('pokemons')
            ->where('id = :id')
            ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {

        $typeOne = $this->getTypeid($parameters['type_one_id']);
        $typeTwo = $this->getTypeid($parameters['type_two_id']);
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('pokemons')
            ->values(
                array(
                    'id' => ':id',
                    'name' => ':name',
                    'sprite' => ':sprite',
                    'description' => ':description',
                    'type_one_id' => ':type_one_id',
                    'type_two_id' => ':type_two_id',
                )
            )
            ->setParameter(':id', $parameters['id'])
            ->setParameter(':name', $parameters['name'])
            ->setParameter(':sprite', $parameters['sprite'])
            ->setParameter(':description', $parameters['description'])
            ->setParameter(':type_one_id',  $typeOne)
            ->setParameter(':type_two_id', $typeTwo);

        $statement = $queryBuilder->execute();
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

    public function getTypeId($name)
    {
        if($name !=null){
            $queryBuilder = $this->db->createQueryBuilder();
            $queryBuilder
                ->select('p.*')
                ->from('types', 'p')
                ->where('name = ?')
                ->setParameter(0, $name);
            $statement = $queryBuilder->execute();
            $typesData = $statement->fetchAll();
            $typeId = $typesData[0]['id'];

            return $typeId;
        }
        else
            return null;
    }


}

