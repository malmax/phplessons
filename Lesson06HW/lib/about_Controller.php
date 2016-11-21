<?php
class about_Controller extends AbstractController
{
	public function __construct($data = array())
	{
		parent::__construct();
		$this->title = 'About';
		$this->content = 'This is content about content';
		if (isset($_GET['param1'])) {
			$this->changeContent();
		}
	}

	protected function changeContent()
	{
		$this->content = $_GET['param1'];
	}
}

?>
