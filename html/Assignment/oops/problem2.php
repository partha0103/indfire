<?php
    trait Person{
    	private $name;
    	public function setName($name){
    		$this->name = $name;
    	}
    	public function getName(){
    		return $name;
    	}
    }

    class  Student
    {
    	use Person;
    	private $registration_no;
    	private $seat_no;
    	public function _construct($name, $registration_no, $seat_no){
    		$this->name = $name;
    		$this->registration_no = $registration_no;
    		$this->seat_no = $seat_no;
    	}
    	public function setRegistrationNo($registration_no){
    		$this->registration_no = $registration_no;
    	}
    	public function getRegistrationNo(){
    		return $registration_no;
    	}
    	public function setSeatNo($seat_no){
    		$this->seat_no = $seat_no;
    	}
    	public function getSeatNo(){
    		return $seat_no;
    	}
    }

    class Teacher
    {
    	use Person;
    	private $students= array();
    	public function addStudent(){
    		$student = new Student("Partha", 28 , 5);
    		array_push($students, $student);
    	}
    }
?>
