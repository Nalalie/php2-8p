<?php

class Config
{
    private static $configCache = [];

    public static function get($parameter)
    {
		//используется метод быстрого получения элемента массива 
		//Вщзвращается элемент массива заданный $parameter
        if (!isset(self::getCurrentConfiguration()[$parameter])) {
            throw new Exception('Parameter ' . $parameter . ' does not exists');
        }
		//Вызываем статический метод getCurrentConfiguration() для получения указанного параметра
        return self::getCurrentConfiguration()[$parameter];
    }

    private static function getCurrentConfiguration()
    {
		//Проверим существование self::$configCache. Возвращает FALSE, если var существует, и содержит непустое и ненулевое значение.
		//если не существуют, то выполняем скрипт
        if (empty(self::$configCache)) {
			//Задаем значения переменных где содержатся конфигурационные данные
            $configDir = __DIR__ . '/../configuration/';
            $configProd = $configDir . 'config.prod.php';
            $configDev = $configDir . 'config.dev.php';
            $configDefault = $configDir . 'config.default.php';
			//Подключаем файлы конфигурации. Если не существует $configProd, то пытаемся подключить $configDev, 
			//если не существует, то подключаем $configDefault, иначе выводим сообщение об ошибке
            if (is_file($configProd)) {
                require_once $configProd;
            } else if (is_file($configDev)) {
                require_once $configDev;
            } else if (is_file($configDefault)) {
                require_once $configDefault;
            } else {
                throw new Exception('Не найден файл конфигурации');
            }
			//Определяем, была ли установлена переменная значением отличным от NULL,
			//если не установленна, то выводим сообщение
            if (!isset($config) || !is_array($config)) {
                throw new Exception('Unable to load configuration. Не загружается файл конфигурации');
            }
			//Присваиваем статическому свойству значение массива $config из файла подключенного ранее.
            self::$configCache = $config;
        }
        return self::$configCache;
    }
}
?>