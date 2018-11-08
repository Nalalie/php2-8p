<?php

class Controller
{
    public $view = 'index';
	protected $data;
	protected $template;
	protected $role = 1;
	
	
	
    function __construct()
    {
		$this->data = [
			'domain' => Config::get('domain'),
			'BreadCrumbs' => Bread::BreadCrumbs(explode("/", $_SERVER['REQUEST_URI'])),
			'isAuth' => Auth::logIn(),
			'role' => Auth::getRole(),
			'microtime' => microtime(true),
			'domain' => Config::get('domain'),
			'basket' => Basket::basketInfo(),
			'title' => $model->title,
			];
	    //Debug::Deb($data);

			

    }

public function controller_view($param = 0)
{
	$modelName = $_GET['page'] . 'Model';
	$methodName = isset($_GET['action']) ? $_GET['action'] : 'Index';
		
	
	if (class_exists($modelName))
	{
		$model = new $modelName();
		$content_data = $model->$methodName($param);  
	}
		
	$this->data['title'] = $model->title;
	$this->data['content_data'] = $content_data;
	Debug::Deb($_SESSION);
	$loader = new Twig_Loader_Filesystem(Config::get('path_templates'));
	$twig = new Twig_Environment($loader);
	$template = $twig->loadTemplate($this->view);
		




	return $template->render($this->data);
	
	
}

	
public function __call($name, $param)
{

	header("Location: /page404/");
}

}