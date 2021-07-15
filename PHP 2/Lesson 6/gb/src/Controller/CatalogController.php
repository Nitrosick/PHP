<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class CatalogController extends AbstractController
{
    /**
     * @Route("/", name="catalog")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('catalog/index.html.twig', [
            'products' => $products
        ]);
    }
}
