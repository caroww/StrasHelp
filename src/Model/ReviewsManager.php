<?php

namespace App\Model;

use PDO;
use App\Model\AdvertsManager;
use App\Controller\AdvertsController;

/**
 *
 */
class ReviewsManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'reviews';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $reviews
     * @return int
     */
    
    public function insert(array $reviews): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`id_order`,`rating`,`comment`) 
        VALUES (:id_order, :rating, :comment)");
        
        
        $statement->bindValue('id_order', $reviews['id_order'], PDO::PARAM_INT);
        $statement->bindValue('rating', $reviews['rating'], PDO::PARAM_INT);
        $statement->bindValue('comment', $reviews['comment'], PDO::PARAM_STR);
      
        if ($statement->execute()) {
            return(int)$this->pdo->lastInsertId();
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
     * @param array $reviews
     * @return bool
     */
    public function update(array $reviews):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `id_order` = :id_order,`rating` = :rating,
        `comment` = :comment WHERE id=:id");



        $statement->bindValue('id', $reviews['id'], PDO::PARAM_INT);
        $statement->bindValue('id_order', $reviews['id_order'], PDO::PARAM_INT);
        $statement->bindValue('rating', $reviews['rating'], PDO::PARAM_INT);
        $statement->bindValue('comment', $reviews['comment'], PDO::PARAM_STR);
        
        return $statement->execute();
    }
}
