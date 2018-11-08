<?php

class galery_ajaxController extends Controller
{
    public $view = 'galery';


public function galery_ajax()
	{
		$this->view .= "/" . __FUNCTION__ . '.php';
		
		$this->data['UPLOAD_SMALL_DIR'] = Config::get('UPLOAD_SMALL_DIR');
		$this->data['UPLOAD_DIR'] = Config::get('UPLOAD_DIR');
		
			
		echo $this->controller_view();			
	}



}