<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index() : Response
    {

        $ordersRep = $this->getDoctrine()->getRepository(Order::class);
        $orders = $ordersRep->findAll();

        $statusRep = $this->getDoctrine()->getRepository(OrderStatus::class);
        $statuses = $statusRep->findAll();

        $procStatus = [];
        foreach ($statuses as $status) {
            $procStatus[ $status->getId() ] = $status->getStatusName();
        }

        $outOrders = [];
        foreach ($orders as $order) {
            /* @var $order \App\Entity\Order */
            $outOrders[ $order->getId() ] = [];
            $outOrders[ $order->getId() ]['created_at'] = $order->getCreatedAt()->format('Y-m-d');
            $outOrders[ $order->getId() ]['status'] = $procStatus[ $order->getOrderStatusId() ];
            $outOrders[ $order->getId() ]['amount'] = $order->getAmount();
        }

        return $this->render('admin/index.html.twig', [ 'orders' => $outOrders ]);
    }
}
