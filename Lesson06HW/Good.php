<?php
class Good
{
	protected $name;
	protected $price;

	public function __construct($name, $price)
	{
		$this->name = $name;
		$this->price = (float)$price;
	}
}

?>
