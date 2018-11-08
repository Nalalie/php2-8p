<?php

class IndexController extends Controller
{
    public $view = 'index';



public function index()
	{
		$this->view .= "/" . __FUNCTION__ . '.php';
		$modelName = $_GET['page'] . 'Model';
		$methodName = isset($_GET['action']) ? $_GET['action'] : 'Index';
		
		$model = new $modelName();
		$content_data = $model->$methodName($_GET);  
	
		$this->data['content_data'] = $content_data;
		
		$loader = new Twig_Loader_Filesystem(Config::get('path_templates'));
		$twig = new Twig_Environment($loader);
		$template = $twig->loadTemplate($this->view);
			
		echo $template->render($this->data);
			
	}





}