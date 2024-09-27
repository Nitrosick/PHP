<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<=100; $i++) {
            $product = new Product();

            $product->setTitle('Товар ' . $i);
            $product->setDescription('Описание товара №' . $i);
            $product->setPrice(rand(49, 1990));
            $product->setCategoryId(rand(1, 3));
            $product->setImage('image_' . $i . '.jpg');

            $manager->persist($product);
            $manager->flush();
        }
    }
}
