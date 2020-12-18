<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\ConnectionManager;

/**
 * Class ConnectionController
 *
 */
class ConnectionController extends AbstractController
{
    /**
     * Display connection listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $connectionManager = new ConnectionManager();
        $connections = $connectionManager->selectAll();

        return $this->twig->render('Connection/index.html.twig', ['connections' => $connections]);
    }

    /**
     * Display connection informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $connectionManager = new ConnectionManager();
        $connection = $connectionManager->selectOneById($id);

        return $this->twig->render('Connection/show.html.twig', ['connection' => $connection]);
    }

    /**
     * Display connection edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $connectionManager = new ConnectionManager();
        $connection = $connectionManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $connection['title'] = $_POST['title'];
            $connectionManager->update($connection);
        }

        return $this->twig->render('Connection/edit.html.twig', ['connection' => $connection]);
    }

    /**
     * Display connection creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function auth()
    {
        $errorMessage = '';

        if (!empty($_POST)) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $connectionManager = new ConnectionManager();
                $connection = $connectionManager->selectEmailAndPassword($_POST['email'], $_POST['password']);

                if (($_POST['email'] !== "" && $_POST['password'] !== "")) {
                    if ($connection[0]["count(*)"] == 0) {
                        $errorMessage = 'E-mail ou mot de passe incorrect !';
                    } else {
                  // On enregistre le login en session
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['id'] = $connectionManager->getID($_SESSION['email']);
                        $_SESSION['isAdmin'] = $connectionManager->getIsAdmin($_SESSION['email']);
                        header('Location:../Home/index');
                    }
                } else {
                    echo 'erreur';
                    header('Location:auth');
                    $errorMessage = 'Veuillez inscrire vos identifiants et mots de passe svp !';
                }
            }
        }
          return $this->twig->render('Connection/auth.html.twig', ['errormessage' => $errorMessage]);
    }

    /**
     * Handle connection deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $connectionManager = new ConnectionManager();
        $connectionManager->delete($id);
        header('Location:/connection/index');
    }
}
