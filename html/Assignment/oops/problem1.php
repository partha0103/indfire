<?php
	/**
     * 
     * @package localhost/Assignment
     * @subpackage oops
     * @author Partha Sarathi Nanda
     **/
	class Person{
		/**
	     * This is the constructor of this class
	     * @param string name
	     * @return Person
	     **/	
	    public function __construct($name){
	  		$this->name = $name;
	  	}

	  	/**
	     * This method returns the name of user
	     * @param void
	     * @return string
	     **/
	  	public function getName(){
	  		return $this->name;
	  	}
	}

	/**
     * 
     * @package localhost/Assignment
     * @subpackage oops
     * @author Partha Sarathi Nanda
     **/
    class BankAccount{
	    private $person = null;
	    private $amount = 0;

	    /**
	     * This is the constructor of Bankaccount class
	     * @param Person
	     * @return BankAccount
	     **/
	    public function __construct($person){
	    	$this->person = $person;
	    }
	    
	    /**
	     * This method adds amount to user's account
	     * @param double $amount
	     * @return void
	     **/
	    public function deposit( $amount ){
	    	$this->amount += $amount;
	    }
	    
	    /**
	     * This method deducts amount from user's account
	     * @param double $amount
	     * @return void
	     **/
	    public function withdraw( $amount ){
	    	if ($this->amount < $amount) {
	    		echo "Insufficient balance";
	    		exit;
	    	}
	    	$this->amount -= $amount;
	    }
	    
	    /**
	     * This method returns current amount of user's account
	     * @param void
	     * @return double
	     **/
	    public function getAmount(){
	    	return $this->amount;
	    }
	    
	    /**
	     * This method prints the statement of user
	     * @param void
	     * @return String 
	     **/
	    public function printStatement(){
	    	echo 'Name : '.  $this->person->getName() . ' , amount = ' .  $this->amount;
	    }
	}

	$person = new Person("PSN");
	$bank_account = new BankAccount($person);
	$bank_account->deposit(1000);
	$bank_account->withdraw(2000);
	$bank_account->printStatement();
?>