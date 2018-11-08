<?php

class goodController extends Controller
{
	
public $view = 'catalog';

	
public function index()
{
	$this->view .= "/" . __FUNCTION__ . '.php';
	echo $this->controller_view();				
}	
	
	
public function good()
{
	$this->view .= "/" . __FUNCTION__ . '.php';	
	echo $this->controller_view($_GET);		
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