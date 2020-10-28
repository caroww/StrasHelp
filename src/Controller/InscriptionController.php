<?php

namespace App\Controller;

use App\Model\InscriptionManager;

/**
 * Class InscriptionController
 */

class InscriptionController extends AbstractController
{


    /**
     * Display Inscription listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $InscriptionManager = new InscriptionManager();

        return $this->twig->render('Inscription/index.html.twig');
    }
}
