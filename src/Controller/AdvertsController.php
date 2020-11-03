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
        $advertsManager = new AdvertsManager();
        $adverts = $advertsManager->selectAll();

        return $this->twig->render('Adverts/index.html.twig', ['adverts' => $adverts]);
    }

    /**
     * Display adverts informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {

        $advertsManager = new AdvertsManager();
        $adverts = $advertsManager->selectOneById($id);

        return $this->twig->render('Adverts/show.html.twig', ['adverts' => $adverts]);
    }


    /**
     * Display adverts edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $advertsManager = new AdvertsManager();
        $adverts = $advertsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adverts['id_category'] = $_POST['id_category'];
            $adverts['advertStatus'] = $_POST['advertStatus'];
            $adverts['searchService'] = $_POST['searchService'];
            $adverts['location'] = $_POST['location'];
            $adverts['duration'] = $_POST['duration'];
            $adverts['description'] = $_POST['description'];
            $adverts['availability'] = $_POST['availability'];
            $adverts['id'] = $id;
            $advertsManager->update($adverts);
        }
        return $this->twig->render('Adverts/edit.html.twig', ['adverts' => $adverts]);
    }


    /**
     * Display adverts creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $advertsManager = new AdvertsManager();
            $adverts = [
                'advertStatus' => $_POST['advertStatus'],
                'searchService' => $_POST['searchService'],
                'id_category' => 1,
                'location' => $_POST['location'],
                'duration' => $_POST['duration'],
                'description' => $_POST['description'],
                'availability' => $_POST['availability'],
                'id_applicant' => 1

            ];
            $id = $advertsManager->insert($adverts);
            header('Location:/adverts/show/' . $id);
        };
        return $this->twig->render('Adverts/add.html.twig');
    }


    /**
     * Handle adverts deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $advertsManager = new AdvertsManager();
        $advertsManager->delete($id);
        header('Location:/adverts/index');
    }
}

