<?php
class PizzaStore
{
	PizzaFactory $pizzaFactory;
	function __construct($pizzaFactory)
	{
		$this->pizzaFactory = $pizzaFactory;
	}
}


?>