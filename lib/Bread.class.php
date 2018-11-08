<?php

class Bread
{

/*
Сохдадим массив для формирования хлебных крошек (быстрой навигации)
*/
public static function BreadCrumbs($url)
{	
	if (is_numeric($url[2])) 
	{
		$id = $url[2];
		//Выполняектся логика построения пути, если просматривается товар
		$sql = "select id_category from goods where id_good = '$id'";
		$sql2 = "SELECT id_pages FROM categories WHERE id_category = ($sql)";
		$sql3 = "select paarent_id from pages WHERE id = ($sql2)";
		$sql4 = "select * from pages where paarent_id < ($sql3)
		UNION select * from pages WHERE id = ($sql2) ORDER BY paarent_id DESC ";
		$crumbs = db::getInstance()->Select($sql4);
		$url = Config::get('domain');
		$parent_id = $crumbs[0]['paarent_id'];
		foreach ($crumbs as $key => $value)
		{
			if ($parent_id != $value['id'])
			{
				if ($crumbs[0]['id'] != $value['id'])
				{
				unset($crumbs[$key]);
				}
			}
			else
			{
				$parent_id = $value['paarent_id'];
			}
		}	
	
		$crumbs = array_reverse($crumbs);	
		
		foreach ($crumbs as $key => $value)
		{

				$url =  $url . $value['url']. '/';
				$bread_crumbs[$url] = $value['name'];
				$parent_id = $value['paarent_id'];
		}	

	} 
	else
	{

		unset($url[0]);
		unset($url[count($url)]);
		$url[1] = "'" . $url[1];
		$url[count($url)] = $url[count($url)] . "'";
		$url_arr = implode("','",$url);
		
		$sql = "SELECT name, url FROM `pages` WHERE url IN ($url_arr) or paarent_id = 0";
		$crumbs = db::getInstance()->Select($sql);
		$url = Config::get('domain');
		foreach ($crumbs as $key => $value)
		{
			$url =  $url . $value['url']. '/';
			$bread_crumbs[$url] = $value['name'];
		}
	}
	return $bread_crumbs;
}


}