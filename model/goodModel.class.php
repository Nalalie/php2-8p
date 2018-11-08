<?php

class goodModel extends Model
{
	public $view = 'good';
	public $title;
	
	function __construct()
	{
		parent::__Construct();
		$this->title .= "Товар";
	}
	
	public function index($data = NULL, $deep = 0)
	{
		
	}
	
	
	public function good($data)
	{
		$this->view .= "/" . __FUNCTION__ . '.php';
		db::getInstance()->Query('UPDATE `goods` SET `view` = `view` + 1 where id_good = "'. $data['id'] .'"');
		$result['product'] = db::getInstance()->Select('select * from goods where id_good = "'. $data['id'] .'"');
		$result['top_product'] = Product::TopProduct();
		$result['new_product'] = Product::NewProduct();
		
		
		
		return $result;
		 
	}	
	
	
}

?>