<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\OrderManager;

/**
 * Class orderController
 *
 */

class OrderController extends AbstractController
{


    /**
     * Display order listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $orderManager = new OrderManager();
        $orders = $orderManager->selectAll();

        return $this->twig->render('Order/index.html.twig', ['order' => $orders]);
    }

    /**
     * Display order informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $orderManager = new OrderManager();
        $order = $orderManager->selectOneById($id);

        return $this->twig->render('Order/show.html.twig', ['order' => $order]);
    }


    /**
     * Display order edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $orderManager = new OrderManager();
        $order = $orderManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order['id'] = $_POST['id'];
            $orderManager->update($order);
        }

        return $this->twig->render('Order/edit.html.twig', ['order' => $order]);
    }

    /**
     * Display order creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderManager = new OrderManager();
            $order = [
                'id' => $_POST['id'],
            ];
            $id = $orderManager->insert($order);
            header('Location:/order/show/' . $id);
        }

        ;
        return $this->twig->render('Order/add.html.twig');
    }


    /**
     * Handle order deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $orderManager = new OrderManager();
        $orderManager->delete($id);
        header('Location:/order/index');
    }
}
