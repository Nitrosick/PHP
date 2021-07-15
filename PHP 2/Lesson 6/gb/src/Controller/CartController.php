<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add", name="cartadd", methods={"post"})
     */
    public function add(Request $request) : Response
    {

        $productID = $request->get('product_id');

        $quantity = $this->getDoctrine()->getRepository(Cart::class)->findBy(['product_id' => $productID]);

        $entityManager = $this->getDoctrine()->getManager();

        if (count($quantity) == 0) {
            $cart = new Cart();
            $cart->setProductId($productID);
            $cart->setQuantity(1);
            $cart->setUserId(1);

            $entityManager->persist($cart);
            $entityManager->flush();

            return $this->redirectToRoute('product', [ 'id' => $productID ]);
        } else {
            $cartItem = $entityManager->getRepository(Cart::class)->findBy(['product_id' => $productID]);

            $cartItem[0]->setQuantity($quantity[0]->getQuantity() + 1);

            $entityManager->flush();

            return $this->redirectToRoute('product', [ 'id' => $productID ]);
        }
    }

    /**
     * @Route("/cart", name="cart", methods={"get"})
     */
    public function index() : Response
    {
        $userID = $_GET['id'];

        $cart = $this->getDoctrine()->getRepository(Cart::class)->findBy(['user_id' => $userID]);
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        foreach($cart as $c) {
            foreach($products as $p) {
                if ($p->getId() == $c->getProductId()) {
                    $c->product_info = $p;
                }
            }
        }

        $total = 0;

        foreach($cart as $c) {
            $total += $c->product_info->getPrice() * $c->getQuantity();
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    /**
     * @Route("/cart/remove", name="cartremove", methods={"get"})
     */
    public function remove()
    {
        $productID = $_GET['id'];

        $entityManager = $this->getDoctrine()->getManager();

        $product = $this->getDoctrine()->getRepository(Cart::class)->findBy(['id' => $productID]);

        $entityManager->remove($product[0]);
        $entityManager->flush();

        return $this->redirectToRoute('cart', ['id' => 1]);
    }

    /**
     * @Route("/checkout/", name="checkoutpost", methods={"post"})
     */
    // public function checkoutCartProcessing()
    // {

    // }
}
