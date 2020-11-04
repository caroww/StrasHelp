<?php

namespace App\Controller;

use App\Model\IdentityManager;

/**
 * Class IdentityController
 */
class IdentityController extends AbstractController
{

    /**
     * Display Identity listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $identityManager = new IdentityManager();
        $identity = $identityManager->selectAll();

        return $this->twig->render('Identity/index.html.twig', ['identity' => $identity]);
    }

    /**
     * Display Identity information specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function show(int $id)
    {
        $identityManager = new IdentityManager();
        $identity = $identityManager->selectOneById($id);

        return $this->twig->render('Identity/show.html.twig', ['identity' => $identity]);
    }

    /**
     * Display Identity edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $identityManager = new IdentityManager();
        $identity = $identityManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identity['id'] = $id;
            $identity['firstname'] = $_POST['firstname'];
            $identity['lastname'] = $_POST['lastname'];
            $identity['gender'] = $_POST['gender'];
            $identity['date_of_birth'] = $_POST['date_of_birth'];
            $identity['city'] = $_POST['city'];
            $identity['phone'] = $_POST['phone'];
            $identity['email'] = $_POST['email'];
            $identity['password'] = $_POST['password'];
            $identityManager->update($identity);
        }
        return $this->twig->render('Identity/edit.html.twig', ['identity' => $identity]);
    }

    /**
     * Display Identity creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identityManager = new IdentityManager();
            $identity = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'gender' => $_POST['gender'],
                'date_of_birth' => $_POST['date_of_birth'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            $id = $identityManager->insert($identity);
            header('Location:/Identity/show/' . $id);
        };
        return $this->twig->render('Identity/add.html.twig');
    }

    /**
     * Handle Identity deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $identityManager = new IdentityManager();
        $identityManager->delete($id);
        header('Location:/Identity/index');
    }
}
