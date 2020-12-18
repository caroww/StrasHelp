<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\CategoryManager;
use App\Model\AdvertsManager;

/**
 * Class CategoryController
 *
 */
class CategoryController extends AbstractController
{


    /**
     * Display category listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $categoryManager = new CategoryManager();
        $categorys = $categoryManager->selectImagesAndCategory();

        return $this->twig->render('Category/index.html.twig', ['categorys' => $categorys]);
    }

    /**
     * Display category informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneById($id);

        return $this->twig->render('Category/show.html.twig', ['category' => $category]);
    }


    /**
     * Display category edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category['name'] = $_POST['name'];
            $categoryManager->update($category);
        }

        return $this->twig->render('Category/edit.html.twig', ['category' => $category]);
    }


    /**
     * Display category creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryManager = new CategoryManager();
            $category = [
                'name' => $_POST['name'],
            ];
            $id = $categoryManager->insert($category);
            header('Location:/category/show/' . $id);
        };
        return $this->twig->render('Category/add.html.twig');
    }


    /**
     * Handle category deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $categoryManager = new CategoryManager();
        $categoryManager->delete($id);
        header('Location:/category/index');
    }

    /**
     * Display adverts informations specified by $id.category
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showAdvertsCategory(int $id)
    {
        $categoryManager = new CategoryManager();
        $adverts = $categoryManager->selectAdvertsByCategory($id);

        return $this->twig->render('Category/showAdvertsCategory.html.twig', ['adverts' => $adverts]);
    }
}
