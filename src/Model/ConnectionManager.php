<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class ConnectionManager extends AbstractManager
{
    /**
     *
     */
    protected const TABLE = 'identity';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


/**
     * Get email and password.
     *
     * @return array
     */
    public function selectEmailAndPassword(string $email, string $password): array
    {
        $statement = $this->pdo->prepare("SELECT count(*) FROM identity WHERE email=:email AND password=:password");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->bindValue('password', md5($password), \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getIsAdmin(string $email): array
    {
        $statement = $this->pdo->prepare("SELECT isAdmin FROM identity WHERE email=:email");

        $statement->bindValue(':email', $email, \PDO::PARAM_STR);

        $statement->execute();
        return $statement->fetch();
    }

    public function getID(string $email)
    {
        $statement = $this->pdo->prepare("SELECT id FROM identity WHERE email=:email");

        $statement->bindValue(':email', $email, \PDO::PARAM_STR);

        $statement->execute();
        $tempId = $statement->fetch();
        $id = $tempId['id'];
        return $id;
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $connection
     * @return bool
     */
    public function update(array $connection): bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $connection['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $connection['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
