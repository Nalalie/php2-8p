<?php

class Page404Controller extends Controller
{
	
public $view = 'page404';

	
public function index()
{
	$this->view .= "/" . __FUNCTION__ . '.php';
	echo $this->controller_view();				
}	
	
	
	


}