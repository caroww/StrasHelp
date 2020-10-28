<?php

namespace App\Controller;

use App\Model\PublishManager;

/**
 * Class PublishController
 */

class PublishController extends AbstractController
{


    /**
     * Display Publish listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $PublishManager = new PublishManager();

        return $this->twig->render('Publish/index.html.twig');
    }
}