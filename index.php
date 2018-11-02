<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>

<?php	
	
	if (!class_exists("Memcache")) exit("Memcached не установлен");
	$memcache = new Memcache;
	$memcache->connect('localhost',11211) or exit("Неудачная попытка подключения");

	echo $memcache->getVersion() . "<br>";

	echo $memcache->get('key');
	$memcache->set('key','Информация для сохранения <br>',false,10);
	
	class InstantCache
	{
		const PREFIX = 'php2-8_';
		
		protected static $instance = NULL;
		
		
		protected static function Connect()
		{
			if (self::$instance) return false;
			$instance = new Memcache();
			$instance->connect('localhost', 11211);
			self::$instance = $instance;
		}
		
		
		public static function get($key)
		{
			if (!self::$instance)
			{
				self::Connect();
			}
			$key = self::PREFIX . $key;
			return self::$instance->get($key);
		}		
		
		
		public static function set($key, $value, $time = 60)
		{
			if (!self::$instance)
			{
				self::Connect();
			}
			$key = self::PREFIX . $key;
			return self::$instance->set($key, $value, FALSE, $time);
		}
				
		
		
		public static function remove($key)
		{
			if (!self::$instance)
			{
				self::Connect();
			}
			$key = self::PREFIX . $key;
			return self::$instance->delete($key);
		}
	
	}
	
	
	echo InstantCache::get('123');
	InstantCache::set('123','qwerty',15);
	
?>


</body>
</html>