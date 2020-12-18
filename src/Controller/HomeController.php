<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['searchWhat']) && !empty($_POST['searchWhere'])) {
                $homeManager = new HomeManager();
                $homeBar = $homeManager-> searchBar($_POST['searchWhat'], $_POST['searchWhere']);

                $searchWhat = isset($_POST['searchWhat']) ? $_POST['searchWhat'] : " ";
                $searchWhere = isset($_POST['searchWhere']) ? $_POST['searchWhere'] : " ";

                return $this->twig->render('Home/searchBarResult.html.twig', ['homeBar' => $homeBar,
                'searchWhat' => $searchWhat, 'searchWhere' => $searchWhere]);
            } else {
                return $this->twig->render('Home/index.html.twig');
            }
        } else {
            return $this->twig->render('Home/index.html.twig');
        }
    }
}
