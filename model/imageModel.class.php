<?php

class imageModel extends Model
{
	public $view = 'good';
	public $title;
	
	function __construct()
	{
		parent::__Construct();
		$this->title .= "Фото";
	}
	
	
	public function good($id)
	{

	$id = (int)($id);	//Самый простой и достаточный способ защиты от sql инъекции. Какой бы параметр мы не получили, он в любом случае будет принудительно преобразован в число
	$sql = "Select * from galery where id_galery = '$id';";
	$galery = db::getInstance()->Select($sql);

	if ($galery) //Если получен результат, то увеличиваем количество просмотров на 1
	{
		$sql = "UPDATE galery SET `view` = `view` + 1 where id_galery = '$id'";
		db::getInstance()->Query($sql);
		return $galery[0];
	}
	else
	{


		exit();
	}
		 
	}	
	
	
}

?>