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
class OrderManager extends AbstractManager
{
    /**
     *
     */
    public const TABLE = 'orderHelp';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $order
     * @return int
     */
    public function insert(array $order): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " (id_advert,id_receiver,id_category,validated) 
            VALUES (:id_advert,:id_receiver,:id_category,:validated)"
        );
        $statement->bindValue(':id_category', $order['id_category'], \PDO::PARAM_INT);
        $statement->bindValue(':id_receiver', $order['id_receiver'], \PDO::PARAM_INT);
        $statement->bindValue(':id_advert', $order['id_advert'], \PDO::PARAM_INT);
        $statement->bindValue(':validated', $order['validated'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        } return 0;
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
     * @param array $order
     * @return bool
     */
    public function update(array $order): bool
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE . " SET id_advert = :id_advert, 
            id_receiver = :id_receiver, id_category = :id_category, validated = :validated WHERE id=:id"
        );
        $statement->bindValue(':id', $order['id'], \PDO::PARAM_INT);
        $statement->bindValue(':id_category', $order['id_category'], \PDO::PARAM_INT);
        $statement->bindValue(':id_receiver', $order['id_receiver'], \PDO::PARAM_INT);
        $statement->bindValue(':id_advert', $order['id_advert'], \PDO::PARAM_INT);
        $statement->bindValue(':validated', $order['validated'], \PDO::PARAM_INT);
        return $statement->execute();
    }
}
