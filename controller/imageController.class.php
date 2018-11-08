<?php

class imageController extends Controller
{
    public $view = 'galery';


public function good()
	{
		$this->view .= "/" . __FUNCTION__ . '.php';
		
		$this->data['UPLOAD_SMALL_DIR'] = Config::get('UPLOAD_SMALL_DIR');
		$this->data['UPLOAD_DIR'] = Config::get('UPLOAD_DIR');
		
			
		echo $this->controller_view($_GET['id']);			
	}



}