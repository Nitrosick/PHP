<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product")
     */
    public function index($id) : Response
    {

        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if ($product) {
            return $this->render('product/index.html.twig', [
                'product' => $product
            ]);
        } else {
            return $this->render('product/empty.html.twig', []);
        }


    }
}
