<?php

namespace App\Model;

use PDO;

/**
 *
 */
class AdvertsManager extends AbstractManager
{
    /**
     *
     */
    protected const TABLE = 'advert';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $adverts
     * @return int
     */

    public function insert(array $adverts): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " ( `id_category`, 
        `id_applicant`,`advertStatus`, `search_service`, `location`, `duration`, `description`, `availability`) 
        VALUES (:id_category, :id_applicant, :advertStatus, :search_Service, :location, :duration, 
        :description, :availability)");


        $statement->bindValue('id_category', $adverts['id_category'], PDO::PARAM_INT);
        $statement->bindValue('id_applicant', $adverts['id_applicant'], PDO::PARAM_INT);
        $statement->bindValue('advertStatus', $adverts['advertStatus'], PDO::PARAM_INT);
        $statement->bindValue('search_Service', $adverts['searchService'], PDO::PARAM_STR);
        $statement->bindValue('location', $adverts['location'], PDO::PARAM_STR);
        $statement->bindValue('duration', $adverts['duration'], PDO::PARAM_INT);
        $statement->bindValue('description', $adverts['description'], PDO::PARAM_STR);
        $statement->bindValue('availability', $adverts['availability'], PDO::PARAM_STR);
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
        return 0; // Upon failure
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $adverts
     * @return bool
     */
    public function update(array $adverts): bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `id_category` = :id_category,
        `id_applicant` = :id_applicant,
        `advertStatus` = :advertStatus, `search_service` = :search_service, `location` = :location, 
        `duration` = :duration, `description`=:description, 
        `availability`=:availability WHERE id=:id");
        $statement->bindValue('id', $adverts['id'], PDO::PARAM_INT);
        $statement->bindValue('id_category', $adverts['id_category'], PDO::PARAM_INT);
        $statement->bindValue('id_applicant', $adverts['id_applicant'], PDO::PARAM_INT);
        $statement->bindValue('advertStatus', $adverts['advertStatus'], PDO::PARAM_INT);
        $statement->bindValue('search_service', $adverts['searchService'], PDO::PARAM_STR);
        $statement->bindValue('location', $adverts['location'], PDO::PARAM_STR);
        $statement->bindValue('duration', $adverts['duration'], PDO::PARAM_INT);
        $statement->bindValue('description', $adverts['description'], PDO::PARAM_STR);
        $statement->bindValue('availability', $adverts['availability'], PDO::PARAM_STR);
        return $statement->execute();
    }
}
