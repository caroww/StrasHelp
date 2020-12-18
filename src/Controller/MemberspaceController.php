<?php

namespace App\Controller;

use App\Model\MemberspaceManager;
use App\Model\IdentityManager;

/**
 * Class MemberspaceController
 */
class MemberspaceController extends AbstractController
{

    /**
     * Display Memberspace listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $memberspaceManager = new MemberspaceManager();
        $id = $memberspaceManager->getID($_SESSION['email']);
        $identity = $memberspaceManager->selectOneById($id);

        return $this->twig->render('Memberspace/index.html.twig', ['identity' => $identity]);
    }

    /**
     * Display Memberspace edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $identityManager = new MemberspaceManager();
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
        return $this->twig->render('Memberspace/edit.html.twig', ['identity' => $identity]);
    }

    /**
     * Handle Memberspace deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $memberspaceManager = new MemberspaceManager();
        $memberspaceManager->delete($id);

        session_destroy();

        $_SESSION["isAdmin"]['isAdmin'] = ""; // I know where I messed up, too late to change it now
        header("Location: /");
        return $this->twig->render('Home/index.html.twig');
        header('Location:/Home/index');
    }
}
