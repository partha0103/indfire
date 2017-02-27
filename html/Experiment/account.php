<?php
	class Account
	{
		$account_no;
		$balance;
		$type_of_account;
		function __construct($account_no, $balance, $type_of_account)
		{
			$this->account_no = $account_no;
			$this->balance = $balance;
			$this->type_of_account = $type_of_account;
		}
		function getAccount(){
			return new Account();
		}
	}