<?php

namespace App\Model;

use PDO;

class InscriptionManager extends AbstractManager
{

    /**
     * Name of the table in the database
     */
    const TABLE = 'identity';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $identity
     * @return bool
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

        return $statement->execute();
    }
}