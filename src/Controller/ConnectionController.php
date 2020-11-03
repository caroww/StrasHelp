<?php

namespace App\Controller;

use App\Model\ConnectionManager;

/**
 * Class ConnectionController
 */
class ConnectionController extends AbstractController
{


    /**
     * Display Connection listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $ConnectionManager = new ConnectionManager();

        return $this->twig->render('Connection/index.html.twig');
    }
}