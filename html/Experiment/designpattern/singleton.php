<?php 

class SingletonDesign
{
	private static $name;
	private static $regd_no;
	private static $instance = null;
	
	private function __construct($name, $regd_no)
	{
		$this->name = $name;
		$this->regd_no = $regd_no;
	}

	public function getInstance(){
		if(self::$instance == null)
			self::$instance = new SingletonDesign('Partha',1405106028);
		return  self::$instance;
	}

	private function _clone(){}

	private function _wakeup(){}
}

$first = SingletonDesign::getInstance();
$second = SingletonDesign::getInstance();
var_dump($first);
var_dump($second);


?>