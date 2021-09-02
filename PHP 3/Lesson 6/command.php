<?php

/**
 * Абстрактый класс "команды"
 * @abstract
 */
abstract class Command
{
    public abstract function Copy();

    public abstract function Cut();

    public abstract function Paste();
}

/**
 * Класс конкретной "команды"
 */
class RedactorCommand extends Command
{
    /**
     * Текущая операция команды
     *
     * @var string
     */
    public $command;

    /**
     * Класс, для которого предназначена команда
     *
     * @var object of class Redactor
     */
    public $redactor;

    /**
     * Конструктор
     *
     * @param object $redactor
     * @param string $command
     */
    public function __construct($redactor, $command)
    {

        $this->redactor = $redactor;
        $this->command = $command;
    }

    /**
     * Переопределенная функция parent::Copy()
     */
    public function Copy()
    {

        $this->redactor->Operation($this->command);
    }

    /**
     * Переопределенная функция parent::Cut()
     */
    public function Cut()
    {

        $this->redactor->Operation($this->command);
    }

    /**
     * Переопределенная функция parent::Paste()
     */
    public function Paste()
    {

        $this->redactor->Operation($this->command);
    }
}

/**
 * Класс получатель и исполнитель "команд"
 */
class Redactor
{
    public function Operation($command)
    {

        // TODO: Действия в зависимости от входящей команды (копировать, вырезать, вставить)
    }
}

/**
 * Класс, вызывающий команды
 */
class User
{
    /**
     * Этот класс будет получать команды на исполнение
     *
     * @private
     * @var object of class Redactor
     */
    private $redactor;

    public function __construct()
    {

        //создать экземпляр класса, который будет исполнять команды
        $this->redactor = new Redactor();
    }

    /**
     * Функция выполнения команд
     *
     * @param string $method
     */
    public function doMethod($method)
    {

        $command = new RedactorCommand($this->redactor, $method);
        switch ($method) {
            case 'copy':
                $command->Copy();
                break;

            case 'cut':
                $command->Cut();
                break;

            case 'paste':
                $command->Paste();
                break;

            default:
                die();
        }
    }
}


$user = new User();

$user->doMethod('copy');
$user->doMethod('cut');
$user->doMethod('paste');
