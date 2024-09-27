<?php

class Context
{
    private $method;

    public function __construct(Payment $method)
    {

        $this->method = $method;
    }

    public function setPayMethod(Payment $method)
    {

        $this->method = $method;
    }

    public function pay() : void
    {

        // TODO: Код оплаты
    }
}


interface Payment
{
    public function pay() : void;
}

class QiwiPayment implements Payment
{
    public function pay() : void
    {

        // TODO: Код оплаты с помощью Qiwi
    }
}

class YandexPayment implements Payment
{
    public function pay() : void
    {

        // TODO: Код оплаты с помощью Яндекс
    }
}

class WebMoneyPayment implements Payment
{
    public function pay() : void
    {

        // TODO: Код оплаты с помощью WebMoney
    }
}


$context = new Context(new QiwiPayment());
$context->pay();

$context->setPayMethod(new YandexPayment());
$context->pay();
