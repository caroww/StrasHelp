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
use App\Model\CategoryManager;

/**
 *
 */
class HomeManager extends AbstractManager
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
     * Get advert and category
     * @return array
     */
    public function searchBar(string $searchWhat, string $searchWhere): array
    {
        $statement = $this->pdo->prepare("SELECT a.location, a.id, a.search_service, c.name 
        FROM advert a 
        RIGHT JOIN category c 
        ON c.id=a.id_category
        WHERE c.name LIKE :searchWhat
        AND a.location LIKE :searchWhere");
        $statement->bindValue(':searchWhat', '%' . $searchWhat . '%', \PDO::PARAM_STR);
        $statement->bindValue(':searchWhere', '%' . $searchWhere . '%', \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
