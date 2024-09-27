<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductTest extends WebTestCase
{
    public function testProduct(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('GET', '/product/1');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Товар 1');
        $this->assertSelectorTextContains('span', 'Описание товара №1');
    }

    public function testEmptyProduct(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $crawler = $client->request('GET', '/product/1000');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Товар не найден');
    }
}
