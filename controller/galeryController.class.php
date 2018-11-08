<?php

class galeryController extends Controller
{
    public $view = 'galery';


public function index()
	{
		$this->view .= "/" . __FUNCTION__ . '.php';
	
		echo $this->controller_view();	
	
	}


public function galery()
	{
		$this->view .= "/" . __FUNCTION__ . '.php';
		
		$this->data['UPLOAD_SMALL_DIR'] = Config::get('UPLOAD_SMALL_DIR');
		$this->data['UPLOAD_DIR'] = Config::get('UPLOAD_DIR');
		
			
		echo $this->controller_view();			
	}





}