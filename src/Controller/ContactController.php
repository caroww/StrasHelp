<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\ContactManager;

/**
 * Class ItemController
 *
 */
class ContactController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->selectAll();

        return $this->twig->render('Contact/index.html.twig', ['contact' => $contact]);
    }

    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        return $this->twig->render('Contact/show.html.twig', ['contact' => $contact]);
    }

    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact['name'] = $_POST['name'];
            $contact['email'] = $_POST['email'];
            $contact['subject'] = $_POST['subject'];
            $contact['message'] = $_POST['message'];

            $contactManager->update($contact);
        }

        return $this->twig->render('Contact/edit.html.twig', ['contact' => $contact]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactManager = new ContactManager();
            $contact = [
                'name' => $_POST['title'],
                'email' => $_POST['title'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
            ];
            $id = $contactManager->insert($contact);
            header('Location:/contact/show/' . $id);
        };
        return $this->twig->render('Contact/add.html.twig');
    }

    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $contactManager = new ContactManager();
        $contactManager->delete($id);
        header('Location:/contact/index');
    }
}
