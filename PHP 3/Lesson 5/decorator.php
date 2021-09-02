<?php

abstract class AbstractMessanger
{
    abstract public function send($message);
}

class TwitterMessanger extends AbstractMessanger
{
    public function send($message)
    {

    }
}

class FacebookMessanger extends AbstractMessanger
{
    public function send($message)
    {

    }
}

abstract class Messanger extends AbstractMessanger
{
    protected $component;

    public function __construct(AbstractMessanger $component)
    {

        $this->component = $component;
    }
}

class Twitter extends Messanger
{
    public function send($message)
    {
        $message = trim($message);
        $this->component->send($message);
    }
}

class Facebook extends Messanger
{
    public function send($message)
    {
        $message = trim($message);
        $this->component->send($message);
    }
}

$messanger = new Twitter(new TwitterMessanger());

$messanger->send('Some text');
