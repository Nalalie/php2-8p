<?php

class BasketController extends Controller
{
	
public $view = 'basket';

	
public function index()
{
	$this->view .= "/" . __FUNCTION__ . '.php';
	echo $this->controller_view();				
}	
	
	
	
	

public function __call($methodName, $args) 
{
	$result = $this->sub_catalog($args[0]);
	return $result; 
}
	


public function sub_catalog($data)
{
	$this->view .= "/" . __FUNCTION__ . '.php';	
	echo $this->controller_view();	
}	




}