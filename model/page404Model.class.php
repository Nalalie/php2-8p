<?php

class page404Model extends Model
{
    public $view = 'page404';
    public $title;

    function __construct()
    {	
		parent::__Construct();
		$this->title .= "Запрашиваемая вами страница не найдена.";

    }



    public function index($data = NULL, $deep = 0) 
	{
		$result['top_product'] = Product::TopProduct();
		$result['new_product'] = Product::NewProduct();
		$result['sale_product'] = Product::StatusProduct();
		return $result;
    }





}