<?php
class App 
{
	/*Статическая функция Ini.
	Устанавливает подключение к БД
	и запускает статический метод данного класса web.
	*/
    public static function Init() 
    {
        date_default_timezone_set('Europe/Moscow');	//Установим временную зону по умолчанию для всех функций даты/времени в скрипте
		/*
		Вызовем метод getInstance() класса DB. Файл db.class.php 
		Используется метод get('db_user') класса Config с параметром который необходимо получить. Файл Config.class.php
		В указанном примере параметр db_user
		*/
      db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));

		//CLI - интерфейс командной строки
		//php_sapi_name() == 'cli' - означает что скрипт запущен с командной строке
        if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) { //Проверим, установленны ли переменные $_SERVER и $_GET
			if ($_POST['metod'] == 'ajax')
			{
				self::ajax();
			}
			else
			{
				self::web(isset($_GET['path']) ? $_GET['path'] : ''); 
			}
            
        }
    }


    protected static function web($url)
    {
		
        $url = explode("/", $url); //Разбиваем строку с помощью разделителя
	

        if (!empty($url[0])) 
		{ //Проверяем, установленна ли переменная
            $_GET['page'] = $url[0];
            if (!empty($url[1])) 
			{
                if (is_numeric($url[1])) 
				{
                    $_GET['id'] = $url[1];
					$_GET['action'] = 'good';
                } 
				else 
				{
                    $_GET['action'] = $url[1];
                }
                if (isset($url[2])) 
				{
                    $_GET['id'] = $url[2];
                }
            }
        }
        else{
		  $_GET['page'] = 'Index';	//Иначе устанавливаем стартовую страницу
        }

//		Debug::Deb($_GET);
  
        if (isset($_GET['page'])) 
		{		//Проверим, установленна ли переменная
		
Debug::Deb($_GET);
		
			
			$controllerName = $_GET['page'] . 'Controller';
			$methodName = isset($_GET['action']) ? $_GET['action'] : 'Index';
			$controller = new $controllerName();
			$controller->$methodName();
			
		}
    }

	protected static function ajax()
    {
		ob_start(); //Запускаем буферизауию вывода	
	
		$PageAjax = $_POST['PageAjax'];	//Получаем действие на AJAX
		$data = Ajax::$PageAjax();		
		$view = Ajax::$views;
			
		$loader = new Twig_Loader_Filesystem(Config::get('path_templates'));
		$twig = new Twig_Environment($loader);
		$template = $twig->loadTemplate($view);
		
		echo $template->render($data);
		$str = ob_get_contents(); //Записываем в переменную то, что в буфере
		
		ob_end_clean(); //Очищаем буфер

		$_SESSION['time'] = time();	
		$_SESSION['time_data'] = $str;	
		
		echo json_encode($str);
	}
		
}