<?php

class Model
{
    public $view = 'index';
    public $title;


    function __construct()
    {	
        $this->title = Config::get('sitename');
    }



    public function index($data = NULL, $deep = 0) 
	{

    }


	
	public function __call($methodName, $args) 
	{
    	header("Location: Config::get('domain')/page404/");
  	}
	







}