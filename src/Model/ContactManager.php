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
class ContactManager extends AbstractManager
{
    /**
     *
     */
    protected const TABLE = 'contact';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $form
     * @return int
     */
    public function insert(array $form): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE . " (`name`,`email`,`subject`,`message`) 
        VALUES (:name, :email, :subject, :message)"
        );
        $statement->bindValue('name', $form['name'], \PDO::PARAM_STR);
        $statement->bindValue('email', $form['email'], \PDO::PARAM_STR);
        $statement->bindValue('subject', $form['subject'], \PDO::PARAM_STR);
        $statement->bindValue('message', $form['message'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
        return 0; // Upon failure
    }


    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE `id`=:id, `name`=:name, 
         `email`=:email, `subject`=:subject, `message`=:message");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $form
     * @return bool
     */
    public function update(array $form)
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET  `id`=:id,
        `name`=:name, `email`=:email, `subject`=:subject, `message`=:message");
        $statement->bindValue('id', $form['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $form['name'], \PDO::PARAM_STR);
        $statement->bindValue('email', $form['email'], \PDO::PARAM_STR);
        $statement->bindValue('message', $form['message'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
