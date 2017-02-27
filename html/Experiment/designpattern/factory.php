<?php

class Student
{
	public $name;
	public $regd_no;
	function __construct(argument)
	{
	}
}

class StudentFactory
{
	public static function create(){
		$obj = new Student();
		return $obj;
	}
}

?>