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
        $inscriptionManager = new InscriptionManager();
        $inscription = $inscriptionManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inscriptionManager = new InscriptionManager();
            $inscription = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'gender' => $_POST['gender'],
                'date_of_birth' => $_POST['date_of_birth'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            // $id = $inscriptionManager->insert($inscription);
            header('Location:/Inscription/thankyou/');
        };
        return $this->twig->render('Inscription/index.html.twig', ['Inscription' => $inscription]);
    }

    public function thankyou()
    {
        $inscriptionManager = new InscriptionManager();
        $inscription = $inscriptionManager->selectAll();

        return $this->twig->render('Inscription/thankyou.html.twig', ['Inscription' => $inscription]);
    }
}
