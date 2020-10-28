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
    const TABLE = 'Adverts';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $Adverts
     * @return int
     */
    
    public function insert(array $Adverts): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $Adverts['title'], PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
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
     * @param array $Adverts
     * @return bool
     */
    public function update(array $Adverts):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $Adverts['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $Adverts['title'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
