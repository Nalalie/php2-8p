<?php

class IndexModel extends Model
{
    public $view = 'index';
    public $title;

    function __construct()
    {	
		parent::__Construct();
		$this->title .= "Главная страница";

    }



    public function index($data = NULL, $deep = 0) 
	{			
		$result['top_product'] = Product::TopProduct();
		$result['new_product'] = Product::NewProduct();
		$result['sale_product'] = Product::StatusProduct();
		
		if (Auth::getRole() == 1)
		{
			$result['role'] = "Вы вошли под пользователем, который имеет возможность просмотра контента. Права доступа не отличаются от незарегистрированных пользователей. Так можно формировать любые данные в зависимости от пользователя и организовывать любой уровень доступа";
		}
		
		if (Auth::getRole() == 2)
		{
			$result['role'] = "Вы вошли под пользователем, который обладает правом  добавлять статьи и их редактировать. Так можно формировать любые данные в зависимости от пользователя и организовывать любой уровень доступа";
		}
		
		if (Auth::getRole() == 3)
		{
			$result['role'] = "Вы вошли под пользователем, который обладает правом  менять содержимое страниц, просматривать содержимое заказов, корзин пользователей. Так же обладают всеми правами категории пользователей editor. Так можно формировать любые данные в зависимости от пользователя и организовывать любой уровень доступа";
		}
		
		if (Auth::getRole() == 4)
		{
			$result['role'] = "Вы вошли под пользователем, который обладает всеми правами и имеющий полный доступ. Так можно формировать любые данные в зависимости от пользователя и организовывать любой уровень доступа";
		}		
		
		return $result;
    }





}