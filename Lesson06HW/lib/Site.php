<?php
class Site
{
	public static function loadPage($data)
	{
	if (!isset($data['page'])) {
		$data['page'] = 'index';
	}
	$pageControllerName = $data['page'] . '_Controller';
	echo $pageControllerName . '<br>';
	$pageController = null;

	if (class_exists($pageControllerName)) {
		$pageController = new $pageControllerName($data);
	} else {
		die('Страница ' . $data['page'] . ' не найдена!');
	}
	$pageController->display();
	// В шаблонизатор
	/*
	 * ['title' , 'content']
	 */

	}
}
