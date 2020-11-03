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
class InscriptionManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'inscription';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $Inscription
     * @return int
     */
    public function insert(array $inscription): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`firstname`) VALUES (:firstname)");
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`lastname`) VALUES (:lastname)");
        $statement->bindValue('firstname', $inscription['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $inscription['lastname'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

}
    
