<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

use App\Model\AdvertsManager;

/**
 *
 */
class CategoryManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'category';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $category
     * @return int
     */
    public function insert(array $category): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $category['name'], \PDO::PARAM_STR);

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
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $category
     * @return bool
     */
    public function update(array $category): bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name WHERE id=:id");
        $statement->bindValue('id', $category['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $category['name'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Get adverts by category.
     *
     * @return array
     */
    public function selectAdvertsByCategory(int $id): array
    {
        //echo $id;
        return $this->pdo->query('SELECT * FROM advert a join category c 
        on a.id_category=c.id where c.id=' . $id)->fetchAll();
    }

    /**
     * Get category and category's images.
     *
     * @return array
     */
    public function selectImagesAndCategory(): array
    {
        //echo $id;
        return $this->pdo->query('SELECT * FROM imgcat i right join category c on i.id=c.id_imgcategory')->fetchAll();
    }
}
