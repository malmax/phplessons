<?php
require_once('Category.php');
require_once('Good.php');

$Root = new Category('Catalog');

$category1 = new Category('Материнские платы');
$category1->addGood(new Good('Asus 1', 5430));
$category1->addGood(new Good('MSI 1', 4410));
$category1->addGood(new Good('Asrock 1', 3890));
$Root->addChild($category1);

$category2 = new Category('Процессоры');
$category2->addGood(new Good('Intel Celeron', 2560));
$category2->addGood(new Good('Intel i3', 12570));
$category2->addGood(new Good('AMD A6', 4980));
$category2->addGood(new Good('AMD A10', 9562));
$Root->addChild($category2);



if (isset($_GET['category_id'])) {
	if(($found = $Root->find($_GET['category_id'])) !== false) {
		print_r($found->listGoods());
	}
} elseif (isset($_GET['tree_id'])) {
	if(($found = $Root->find($_GET['tree_id'])) !== false) {
		print_r($found);
	}
}

?>
