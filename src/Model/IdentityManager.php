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
class IdentityManager extends AbstractManager
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
     * @param array $identity
     */
    public function insert(array $identity)
    {
        $query = 'INSERT INTO identity (isAdmin, accountStatus, firstname, lastname, gender, date_of_birth, 
city, phone, email, password) VALUES (0, 0, :firstname, :lastname, :gender, :date_of_birth, :city, :phone, 
:email, :password)';

        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':firstname', $identity['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $identity['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':gender', $identity['gender'], PDO::PARAM_STR);
        $statement->bindValue(':date_of_birth', $identity['date_of_birth'], PDO::PARAM_STR);
        $statement->bindValue(':city', $identity['city'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $identity['phone'], PDO::PARAM_STR);
        $statement->bindValue(':email', $identity['email'], PDO::PARAM_STR);
        $statement->bindValue(':password', md5($identity['password']), PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }

        return $statement->execute();
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


    /**
     * @param array $identity
     * @return bool
     */
    public function update(array $identity)
    {
        $query = "UPDATE Identity SET firstname=:firstname, lastname=:lastname, 
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
