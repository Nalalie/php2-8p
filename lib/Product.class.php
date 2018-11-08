<?php

class Product 
{
	public static function TopProduct($quantity = 3, $sort = 'desc')
	{
		return db::getInstance()->Select("select * from goods order by view $sort, date desc limit $quantity;");
	}

	public static function NewProduct($quantity = 3, $sort = 'desc')
	{
		return db::getInstance()->Select("select * from goods order by date $sort limit $quantity;");
	}
	
	public static function StatusProduct($quantity = 3, $status = 2, $sort = 'desc')
	{
		return db::getInstance()->Select("select * from goods where status = '$status' order by view $sort limit $quantity;");
	}	

}