<?php

namespace App\Controller;

use App\Model\ReviewsManager;
use App\Model\AdvertsManager;
use App\Controller\AdvertsController;

/**
 * Class ReviewsController
 */

class ReviewsController extends AbstractController
{


    /**
     * Display Reviews listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $reviewsManager = new ReviewsManager();
        $reviews = $reviewsManager->selectAll();

        return $this->twig->render('Reviews/index.html.twig', ['reviews' => $reviews]);
    }
     /**
     * Display reviews informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {

        $reviewsManager = new ReviewsManager();
        $reviews = $reviewsManager->selectOneById($id);

        return $this->twig->render('Reviews/show.html.twig', ['reviews' => $reviews]);
    }

     /**
     * Display reviews edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $reviewsManager = new ReviewsManager();
        $reviews = $reviewsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviews['id'] = $id;
            $reviews['id_order'] = $_POST['id_order'];
            $reviews['rating'] = $_POST['rating'];
            $reviews['comment'] = $_POST['comment'];

            $reviewsManager->update($reviews);
        }
        return $this->twig->render('Reviews/edit.html.twig', ['reviews' => $reviews]);
    }


    /**
     * Display reviews creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewsManager = new ReviewsManager();
            $reviews = [
                'id_order' => 1,
                'rating' => $_POST['rating'],
                'comment' => $_POST['comment'],
            ];
            $id = $reviewsManager->insert($reviews);
            header('Location:/reviews/show/' . $id);
        }


        return $this->twig->render('Reviews/add.html.twig');
    }


    /**
     * Handle reviews deletion
     *  @param int $id
     */
    public function delete(int $id)
    {
        $reviewsManager = new ReviewsManager();
        $reviewsManager->delete($id);
        header('Location:/reviews/index');
    }
}
