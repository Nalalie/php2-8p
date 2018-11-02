<?php
//подключаем автозагрузчик twig и запускаем статический метод aregister
require_once 'lib/Twig/Autoloader.php'; 
Twig_Autoloader::register();

spl_autoload_register("gbStandardAutoload"); //Регистрируем собственный автозагрузчик

function gbStandardAutoload($className)
{
	// Папки с классами для загрузки
    $dirs = [
        'controller',
        'lib',
        'model/'
    ];
    $found = false;
	//Имя файла формируется из имени класса и '.class.php'
    foreach ($dirs as $dir) { //проходим по всем папкам в поисках соответствующего класса
        $fileName = __DIR__ . '/' . $dir . '/' . $className . '.class.php';
        if (is_file($fileName)) { //если файл существует

            require_once($fileName); //то подключаем его 
            $found = true;	//и ставим метку
        }
    }
    if (!$found) {
		header("Location: /page404/");
//        throw new Exception('Нет файла класса для загрузки: ' . $className . $fileName);	//Если файл с классом не найдет, то выводим сообщение
    }
    return true;
}
