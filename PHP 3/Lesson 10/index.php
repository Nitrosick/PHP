<?php

function makeTree ($expression)
{
	$tokenArray = explode(' ', $expression);

	$weightsArray = [];
	foreach ($tokenArray as $value) {
    	$weightsArray[] = new Symbol($value);
	}

	$tree = new BinaryTree();
	foreach ($weightsArray as $value) {
		$tree->insert($value);
	}

	return $tree;
}

class Symbol
{
	public $value;
	public $weight;

	public function __construct ($value)
	{
		$this->value = $value;
		$this->weight = $this->getWeight($value);
	}

	private function getWeight ($value)
	{
		switch ($value) {
			case '(':
			case ')':
			case '^':
				return 4;
			case '*':
			case '/':
				return 3;
			case '+':
			case '-':
				return 2;
			default:
				return 1;
		}
	}
}

class BinaryNode
{
	public $value;
	public $weight;
	public $left  = NULL;
	public $right = NULL;

	public function __construct ($value)
	{
		$this->value = $value->value;
		$this->weight = $value->weight;
	}
}

class BinaryTree
{
	protected $root = NULL;

	public function isEmpty ()
	{
		return is_null($this->root);
	}

	public function insert ($value)
	{
		$node = new BinaryNode($value);
		$this->insertNode($node, $this->root);
	}

	protected function insertNode (BinaryNode $node, &$subtree)
	{
		if (is_null($subtree))
		{
			$subtree = $node;
		}
		else
		{
			if ($node->weight < $subtree->weight)
			{
				$this->insertNode($node, $subtree->left);
			}
			elseif ($node->weight >= $subtree->weight)
			{
				$this->insertNode($node, $subtree->right);
			}
		}
		return $this;
	}
}

$expression = '( x + 42 ) ^ 2 + 7 * y - z';
$tree = makeTree($expression);

print_r($tree);
