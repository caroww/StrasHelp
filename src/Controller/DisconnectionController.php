<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\DisconnectionManager;

/**
 * Class Disconnection
 *
 */
class DisconnectionController extends AbstractController
{
    /**
     * Display deconnection listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        session_destroy();

        $_SESSION["isAdmin"]['isAdmin'] = "";
        header("Location: /");
        return $this->twig->render('Home/index.html.twig');
    }
}
