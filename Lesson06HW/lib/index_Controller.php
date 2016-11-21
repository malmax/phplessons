<?php
class index_Controller extends AbstractController
{
	public function __construct($data = array())
	{
		parent::__construct($data);
		$this->title = 'Hello';
		$this->content = 'This is content';
	}
}
?>
