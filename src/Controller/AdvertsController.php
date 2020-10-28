<?php

namespace App\Controller;

use App\Model\AdvertsManager;

/**
 * Class AdvertsController
 */

class AdvertsController extends AbstractController
{


    /**
     * Display Adverts listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $ServicesManager = new AdvertsManager();

        return $this->twig->render('Adverts/index.html.twig');
    }
}