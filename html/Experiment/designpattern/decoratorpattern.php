<?php 
interface HtmlElement{
	public function getName();	
}


class InputText extends HtmlElement
{
	protected $element;
	function __construct($element)
	{
		$this->element = $element;
	}

	public function getName(){
		return $this->element->getName();
	}
}



?>