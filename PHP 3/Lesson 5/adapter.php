<?php

class CircleAreaLib
{
   public function getCircleArea(int $diagonal)
   {
       $area = (M_PI * $diagonal**2) / 4;

       return $area;
   }
}

class SquareAreaLib
{
   public function getSquareArea(int $diagonal)
   {
       $area = ($diagonal**2)/2;

       return $area;
   }
}



interface ISquare
{
    function squareArea(int $sideSquare);
}

interface ICircle
{
    function circleArea(int $circumference);
}


class SquareAdapter implements ISquare
{
    protected $object;

    public function __construct()
    {

        $this->object = new SquareAreaLib();
    }

    public function squareArea($sideSquare)
    {

        return $this->object->getSquareArea($sideSquare);
    }
}

class CircleAdapter implements ICircle
{
    protected $object;

    public function __construct()
    {

        $this->object = new CircleAreaLib();
    }

    public function circleArea($circumference)
    {

        return $this->object->getCircleArea($circumference);
    }
}

$circle = new CircleAdapter();
$square = new SquareAdapter();

echo $square->squareArea(5);
echo "<br><br>";
echo $circle->circleArea(10);
