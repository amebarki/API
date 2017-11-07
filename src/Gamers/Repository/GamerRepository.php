<?php

namespace App\Gamers\Repository;
use GuzzleHttp\Client;
use App\Gamers\Entity\Gamer;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;/**
 * gamer repository.
 */
class GamerRepository
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
    * Returns a collection of gamers.
    *
    * @param int $limit
    *   The number of gamers to return.
    * @param int $offset
    *   The number of gamers to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of gamers, keyed by gamer id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('gamers', 'u');

       $statement = $queryBuilder->execute();
       $gamersData = $statement->fetchAll();
       foreach ($gamersData as $gamerData) {
           $gamerEntityList[$gamerData['id']] = new gamer($gamerData['id'], $gamerData['pseudo'], $gamerData['team']);
       }

       return $gamerEntityList;
   }


    /**
        * Returns a collection of users link to a user.
        *
        * @param int $limit
        *   The number of gamers to return.
        * @param int $offset
        *   The number of gamers to skip.
        * @param array $orderBy
        *   Optionally, the order by info, in the $column => $direction format.
        *
        * @return array A collection of users, keyed by gamer id.
        */
    public function getAllUsers($id)
    {

       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('gamers', 'u')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $gamerData = $statement->fetchAll();
       return new gamer($gamerData[0]['id'], $gamerData[0]['pseudo'], $gamerData[0]['team']);
    }


   /**
    * Returns an gamer object.
    *
    * @param $id
    *   The id of the gamer to return.
    *
    * @return array A collection of gamers, keyed by gamer id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('gamers', 'u')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $gamerData = $statement->fetchAll();

       return new gamer($gamerData[0]['id'], $gamerData[0]['pseudo'], $gamerData[0]['team']);
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('gamers')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('gamers')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['pseudo']) {
            $queryBuilder
              ->set('pseudo', ':pseudo')
              ->setParameter(':pseudo', $parameters['pseudo']);
        }

        if ($parameters['team']) {
            $queryBuilder
            ->set('team', ':team')
            ->setParameter(':team', $parameters['team']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('gamers')
          ->values(
              array(
                'pseudo' => ':pseudo',
                'team' => ':team',
              )
          )
          ->setParameter(':pseudo', $parameters['pseudo'])
          ->setParameter(':team', $parameters['team']);
        $statement = $queryBuilder->execute();
    }


public function response()
{
  $client = new Client();
  $response = $client->request('GET', 'http://pokeapi.co/api/v2/pokemon/1');
  return new Response(
    $response->getBody(),
    $response->getStatusCode(),
    ['Content-type'=>'application/json']);
}

}
