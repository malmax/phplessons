<?php
class Category
{
	protected $name;
	protected $id; // уникальный идентификатор объекта

	protected $goods = []; // массив товаров
	protected $children = []; // массив потомков

	protected static $lastInsertedId = 0; // счетчик объектов

	public function __construct($name)
	{
		// в конструкторе каждый раз увеличиваем счетчик
		$this->id = ++self::$lastInsertedId;
		// и присваиваем имя
		$this->name = $name;
	}

	public function getId() {
		return $this->id;
	}

	// метод, показывающий список товаров в категории
	public function listGoods()
	{
		return $this->goods;
	}

	// метод, добавляющий подкатегорию
	public function addChild(Category $category)
	// !!! аргумент $category типа Category - очень важно!
	{
		$this->children[] = $category;
	}
	
	// метод, добавляющий товар в текущую категорию
	public function addGood(Good $item)  
	// !!! аргумент $item типа Good - очень важно!
	{
		$this->goods[] = $item;
	}

	// Находим нужную категорию в дереве
	public function Find($id)
	{
		$id = intval($id);
		// если текущий объект имеет искомый id - возвращаем его
		if ($this->id === $id) {
			return $this;
		}
		
		// иначе, рекурсивно пробегаемся по категориям
		if (count($this->children) > 0) {
			foreach ($this -> children as $child) {
				$result = $child->Find($id);
				// если присвоение прошло удачно - возвращаем объект
				if ($result) {
					return $result;
				}
			}
		}
		return false;
	}
}

?>
