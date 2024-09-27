<?php

class MathHeap
{
    public $mathExpression;
    public $stack;
    public $operators = ['^', '*', '/', '+', '-'];

    public function __construct() {
		$this->stack = new SplStack();
	}

    public function setMathExpression(string $mathExpression) {
		$this->mathExpression = $mathExpression;
	}

    public function makeTree() {
        $result = "";
        $expressionArr = preg_split('//', $this->mathExpression, -1, PREG_SPLIT_NO_EMPTY);

        for ($i = 0; $i < count($expressionArr); $i++) {
			$symbol = $expressionArr[$i];

            if (is_numeric($symbol)) {
                while (is_numeric($expressionArr[$i]) || $expressionArr[$i] == '.' || $expressionArr[$i] == ',') {
                    $result .= $expressionArr[$i];
                    $i++;
                }
                $i--;
                $result .= ' ';
            } elseif (in_array($symbol, $this->operators)) {
                while (!$this->stack->isEmpty() && $this->operatorPriority($this->stack->top()) >= $this->operatorPriority($symbol)) {
					$result .= $this->stack->pop() . ' ';
				}
                $this->stack->push($symbol);

            } elseif ($symbol == '(') {
                $this->stack->push($symbol);

            } elseif ($symbol == ')') {
                while ($this->stack->top() != '(') {
					$result .= $this->stack->pop() . ' ';
                }
                $this->stack->pop();

            } elseif ($symbol == ' ') {
                continue;

            } else {
                $result .= $symbol . ' ';
            }
        }

        while (!$this->stack->isEmpty()) {
			$result .= $this->stack->pop() . ' ';
		}

        return $result;
    }

    public function operatorPriority(string $operator)
	{
		switch ($operator) {
			case '^' : return 3;
			case '*' :
			case '/' : return 2;
			case '+' :
			case '-' : return 1;
		}
		return 0;
	}
}

$mathExpression = '(x + 42) ^ 2.578 + 7 * y - z';

echo "Пользовательское выражение: $mathExpression <br>";

$mathHeap = new MathHeap();
$mathHeap -> setMathExpression($mathExpression);
$mathTree = $mathHeap->makeTree();

echo "Обход дерева: $mathTree";