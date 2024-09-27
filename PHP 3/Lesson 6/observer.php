<?php

interface SubjectInterface
{
    public function getTitle();
    public function getRequireExp();
}

interface BoardInterface
{
    public function addVacation(SubjectInterface $subject);
    public function attachObserver (ObserverInterface $observer);
    public function detachObserver (ObserverInterface $observer);
    public function notify(SubjectInterface $subject);
}

interface ObserverInterface
{
    public function update(SubjectInterface $subject);
}

class Vacation implements SubjectInterface
{
    private $title;
    private $requireExp;

    public function __construct ($title, $requireExp) {
        $this->title = $title;
        $this->requireExp = $requireExp;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getRequireExp() {
        return $this->requireExp;
    }
}

class VacationList implements BoardInterface
{
    private $observers = [];
    private $vacations = [];

    public function addVacation(SubjectInterface $vacation) {
        $this->vacations = $vacation;
    }

    public function attachObserver (ObserverInterface $observer) {
        $this->observers[] = $observer;
    }

    public function detachObserver (ObserverInterface $observer) {
        foreach ($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
                return;
            }
        }
    }

    public function notify(SubjectInterface $vacation) {
        foreach ($this->observers as $obs) {
            $obs->update($vacation);
        }
    }
}

class Researcher implements ObserverInterface
{
    private $email;
    private $name;
    private $experience;

    public function __construct($name, $email, $experience) {
        $this->name = $name;
        $this->email = $email;
        $this->experience = $experience;
    }

    public function getEmail()
    {

        return $this->email;
    }

    public function getName()
    {

        return $this->name;
    }

    public function getExperience()
    {

        return $this->experience;
    }

    public function update(SubjectInterface $vacation) {
        $researcherName = $this->getName();
        $vacationTitle = $vacation->getTitle();
        $vacationExperience = $vacation->getRequireExp();

        if ($this->experience >= $vacationExperience) {
            printf("$researcherName получил(а) уведомление о новой вакансии -  $vacationTitle, требуемый опыт: $vacationExperience");
            echo "<br>";
        }
    }
}

$vacation1 = new Vacation("middle PHP-разработчик", 5);
$vacation2 = new Vacation("junior PHP-разработчик", 1);

$vacationList = new VacationList;

$vacationList->addVacation($vacation1);
$vacationList->addVacation($vacation2);

$researcher1 = new Researcher("Никитян", "buni92@mail.ru", 4);
$researcher2 = new Researcher("Стасян", "stastopaz@mail.ru", 1);
$researcher3 = new Researcher("Паштет", "pastetbuz@mail.ru", 6);

$vacationList->attachObserver($researcher1);
$vacationList->attachObserver($researcher2);
$vacationList->attachObserver($researcher3);

$vacationList->notify($vacation1);
$vacationList->notify($vacation2);
