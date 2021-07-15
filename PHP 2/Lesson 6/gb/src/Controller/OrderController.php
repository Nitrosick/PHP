<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order", methods={"get"})
     */
    public function index(): Response
    {
        $userID = $_GET['id'];
        $total_price = floatval($_GET['total']);

        $entityManager = $this->getDoctrine()->getManager();

        $order = new Order();
        $order->setUserId($userID);
        $order->setAmount($total_price);
        $order->setCreatedAt(new DateTimeImmutable('now'));
        $order->setOrderStatusId(1);

        $entityManager->persist($order);
        $entityManager->flush();

        $cart = $entityManager->getRepository(Cart::class)->findBy(['user_id' => $userID]);

        foreach($cart as $c) {
            $entityManager->remove($c);
        }
        $entityManager->flush();

        return $this->redirectToRoute('show_orders');
    }

    /**
     * @Route("/show_orders", name="show_orders")
     */
    public function showOrders(): Response
    {
        $req = $this->getDoctrine()->getRepository(Order::class)->findAll();

        $orders = [];
        foreach($req as $r) {
            $orders[$r->getId()]['id'] = $r->getId();
            $orders[$r->getId()]['user_id'] = $r->getUserId();
            $orders[$r->getId()]['amount'] = $r->getAmount();
            $orders[$r->getId()]['created_at'] = $r->getCreatedAt()->format('Y-m-d H:i:s');
        }

        krsort($orders);

        return $this->render('order/index.html.twig', [
            'orders' => $orders
        ]);
    }
}
