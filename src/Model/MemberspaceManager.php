<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

use PDO;

/**
 *
 */
class MemberspaceManager extends AbstractManager
{

    /**
     * Name of the table in the database
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
     * @param int $id
     */
    public function delete(int $id): void
    {
        $query = "DELETE FROM identity WHERE id=:id";
        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();
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
     * @param array $identity
     * @return bool
     */
    public function update(array $identity)
    {
        $query = "UPDATE identity SET firstname=:firstname, lastname=:lastname, 
gender=:gender, date_of_birth=:date_of_birth, city=:city, phone=:phone, email=:email, 
password=:password WHERE id=:id";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':id', $identity['id'], PDO::PARAM_STR);
        $statement->bindValue(':firstname', $identity['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $identity['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':gender', $identity['gender'], PDO::PARAM_STR);
        $statement->bindValue(':date_of_birth', $identity['date_of_birth'], PDO::PARAM_STR);
        $statement->bindValue(':city', $identity['city'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $identity['phone'], PDO::PARAM_STR);
        $statement->bindValue(':email', $identity['email'], PDO::PARAM_STR);
        $statement->bindValue(':password', $identity['password'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
