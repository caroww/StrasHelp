<?php

namespace App\Controller;

use App\Model\MembersManager;

/**
 * Class MembersController
 */
class MembersController extends AbstractController
{


    /**
     * Display Members listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $MembersManager = new MembersManager();

        return $this->twig->render('Members/index.html.twig');
    }
}