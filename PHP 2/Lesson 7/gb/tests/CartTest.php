<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartTest extends WebTestCase
{
    public function testAddToCart(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('POST', '/cart/add', [ 'product_id' => 1 ]);

        $this->assertResponseRedirects('/product/1');
    }

    public function invalidAddToCart(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('POST', '/cart/add', [ 'product_id' => 0 ]);

        $this->assertResponseStatusCodeSame(500);
    }

    public function testEmptyCart(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('GET', '/cart/1000');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Ваша корзина пуста');
    }

    public function testRemoveFromCart(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('GET', '/cart/remove/1');

        $this->assertResponseRedirects('/cart/1');
    }
}
