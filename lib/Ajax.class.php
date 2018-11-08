<?php

class Ajax
{

public static $views;


public static function register()
{
	self::$views = 'auth.html';
	
	return ['isAuth' => Auth::logIn($_POST['login'], $_POST['pass'], $_POST['rememberme'])];
}

/*
Метод добавления товара в корзину
*/
public static function addGoods()
{
	self::$views = 'basket_count.html';
	$isAuth = true;
	$_POST['count_goods'] = isset($_POST['count_goods']) ? (int)$_POST['count_goods'] : 1;

	return Basket::addGoods($_POST['uid'], $_POST['count_goods'], $isAuth);
}
	
	
	
public static function see_additional_goods()
{
	self::$views = 'catalog/product_catalog.php';
	$model = new catalogModel();
	$nStart = $_POST['current_record'];
	$count = $_POST['count'];
	$data = $_POST['category'];
	return ['content_data' => $model->sub_catalog($data, $nStart, $count)];
}


}