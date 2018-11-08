<?php

class Basket
{


//Метод, показывающий общую информацию о корзине. В данный момент представленна в виде заглушки
//Реализуется при помощи обычных sql запросов к БД
public static function basketInfo()
{
	//Стоимость корзины	
	$basket_price = 100;
	//Количество наименований товаров в корзине
	$basket_count = 10;
	//Общее количество товаров в корзине
	$basket_count_good = 15;
	
	//Составим массив для отправки в браузер
	$result['basket_count_good'] = $basket_count_good;
	$result['basket_count'] = $basket_count;
	$result['basket_price'] = $basket_price;	
	
	return $result;
}

//В случае, если пользователь авторизован, то берем корзину из БД и сохраняем ее в сессии и в cookie
public static function basketIsAuth()
{
	$id_user = $_SESSION['IdUserSession'];
	
	$sql['sql'] = "select * from basket where id_user = (select id_user from users_auth where hash_cookie = :id_user)";
	$sql['param'] = 
		[
			'id_user' => $id_user,
		];		
	$basket_db = db::getInstance()->SelectRow($sql['sql'], $sql['param']);

	
	foreach ($basket_db as $key => $value)
	{
		$basket[$value['ID_UUID']] = $value['count'];
	}
	
	$_SESSION['basket'] = $basket;
	$mass_basket_json = json_encode($basket);
	setcookie('basket', $mass_basket_json, TIME_COOKIE_BASKET, '/');
	return $basket;
}

//Соединяем корзину из сессии с корзиной из cookie
public static function BasketSessionCookie()
{
	if ($_SESSION['basket'])
	{
		$mass_basket_json = json_decode($_COOKIE['basket'],true);
		if (is_array($mass_basket_json))
		{
			$basket = array_merge($mass_basket_json, $_SESSION['basket']);
		}
	}
	
	$_SESSION['basket'] = $basket;
}

/*
Получаем корзину из БД
*/	
private static function BasketGetDB()
{
	$id_user = $_SESSION['IdUserSession'];
	
	$sql['sql'] = "select * from basket where id_user = (select id_user from users_auth where hash_cookie = :id_user)";
	$sql['param'] = 
		[
			'id_user' => $id_user,
		];	
	
	
	$basket_db = db::getInstance()->Select($sql['sql'], $sql['param']);

//	Debug::Deb($basket_db);
	foreach ($basket_db as $key => $value)
	{
		$basket[$value['ID_UUID']] = $value['count'];
	}
	
//	Debug::Deb($basket);
	return $basket;
}

	
/*
Удаляем корзину из БД
*/
private static function BasketDeleteDB($id_user = null)	
{
//	$sql = 'DELETE FROM `basket` WHERE `basket`.`id_user` = 1';
	$sql['sql'] = "DELETE FROM `basket` WHERE `basket`.`id_user` = :id_user";
	$sql['param'] = 
		[
			'id_user' => $id_user,
		];
	
	db::getInstance()->Query($sql['sql'], $sql['param']);

}
	
/*
Запись корзины в БД
*/	
private static function BasketSetDB($basket, $id_user)
{
	
	
	$sql['sql'] = "insert into basket (id_uuid, count, id_user) value (:data_product_guid, :count_goods, :id_user);";
	foreach ($basket as $key=>$value)
	{
		$sql['param'] = 
			[
				'data_product_guid' => $key,
				'count_goods' => $value,
				'id_user' => $id_user,
			];	
		db::getInstance()->Query($sql['sql'], $sql['param']);	
	}
}
	
/*Соединяем корзину из сессий с корзиной из БД. Необходимо выполнить в случае объединения корзин из куков и сессий	
*/
public static function BasketDBSession($id_user)
{
	/*
	Данный подход можно реализовать SQL запросом, но в таком случае запрос будет довольно объемный и трудным для начального понимания. Поэтому реализуем все следующим образом.
	*/
	
	//Возьмем корзину из БД и сохраним ее в переменной
	//Используем написанный метод
	$basket = self::BasketGetDB();
	
	//Объеденим корзину из БД хранящуюся в переменной из предыдущего шага и объеденим с корзиной из сессий
	if (is_array($basket) && is_array($_SESSION['basket']))
	{	
		$basket = array_merge($_SESSION['basket'], $basket);
	}
	else if (is_array($_SESSION['basket']))
	{
		$basket = $_SESSION['basket'];
	}
	
	
	
	//Удалим корзину из БД
	self::BasketDeleteDB($id_user);
	
	//Запишем новую корзину в БД
	self::BasketSetDB($basket, $id_user);
}
	

//Добавление товара в корзину
public static function addGoods($data_product_guid, $count_goods = 1, $isAuth = false)
{

	$count_goods = (int)$count_goods; 
	$basket = $_SESSION['basket'];

	$basket[$data_product_guid] = $count_goods == 1 ? $basket[$data_product_guid]  + $count_goods : $count_goods;
	
	$count_goods = $basket[$data_product_guid];
	
	
	if ($isAuth)
	{
		$idUserSession = $_SESSION['IdUserSession'];

		//Создадим ззапрос для проверки наличия записи в БД
		$sql['sql'] = "select * from basket where ID_UUID = :data_product_guid and id_user = (select id_user from users_auth where hash_cookie = :idUserSession)";
		$sql['param'] = 
			[
				'data_product_guid' => $data_product_guid,
				'idUserSession' => $idUserSession,
			];		
		$goods_basket = db::getInstance()->SelectRow($sql['sql'], $sql['param']);

		$id = $goods_basket['id'];
		if ($goods_basket) //Если товар имеется в корзине
		{
			$sql['sql'] = "update basket set count = :count_goods where id = :id";
			$sql['param'] = 
				[
					'id' => $id,
					'count_goods' => $basket[$data_product_guid],
				];	
			db::getInstance()->Query($sql['sql'], $sql['param']);
		}
		else
		{
			$sql['sql'] = "insert into basket (id_uuid, count, id_user) value (:data_product_guid, :count_goods, (select id_user from users_auth where hash_cookie = :idUserSession));";
			$sql['param'] = 
				[
					'data_product_guid' => $data_product_guid,
					'count_goods' => $count_goods,
					'idUserSession' => $idUserSession,
				];	
			db::getInstance()->Query($sql['sql'], $sql['param']);
		}
		
	}
	
	$_SESSION['basket'] = $basket;

	//Преобразуем массив с корзиной в формат json и запишем данные так же в куки.
	$mass_basket_json = json_encode($basket);
	setcookie('basket', $mass_basket_json, Config::get('TIME_COOKIE_BASKET'), '/');
	return $result;
}




//Очистка корзины полная или выборочная запись
public static function ClearBasket($isAuth = false, $uuid = NULL)
{
	$basket = $_SESSION['basket'];
	$idUserSession = $_SESSION['IdUserSession'];
	//Если указан идентификатор товара, то удаляем конкретный товар
	if ($uuid)
	{
		unset($basket[$uuid]);
		if ($isAuth)
		{
			
			$sql['sql'] = "DELETE FROM `basket` WHERE `basket`.`ID_UUID` = :uuid and `basket`.`id_user` = (select id_user from users_auth where hash_cookie = :idUserSession);";
			$sql['param'] = 
				[
					'uuid' => $uuid,
				];	
			db::getInstance()->Query($sql['sql'], $sql['param']);			
		}
	}
	else //В противном случае уничтожаем полностью корзину
	{
		if ($isAuth)
		{
//			$idUserSession = $_SESSION['IdUserSession'];
			$sql['sql'] = "DELETE FROM `basket` WHERE `basket`.`id_user` = (select id_user from users_auth where hash_cookie = :idUserSession);";
			$sql['param'] = 
				[
					'idUserSession' => $idUserSession,
				];	
			db::getInstance()->Query($sql['sql'], $sql['param']);	
		}
		unset($basket);
	}
	
	//Так же делаем запись в сессиях и куках
	$_SESSION['basket'] = $basket;
	$mass_basket_json = json_encode($basket);
	setcookie('basket', $mass_basket_json, Config::get('TIME_COOKIE_BASKET'), '/');
	return $result;
}	

	
	
	
}
	
?>