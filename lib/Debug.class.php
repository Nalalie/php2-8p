<?php
class Debug
{


	public static function TimeSpeed($nameFunc1, $nameFunc2, $it=50)
	{
		$sum_avg1 = TimeFunc($nameFunc1, $it)[2];
		$sum_avg2 = TimeFunc($nameFunc2, $it)[2];
	
		$speed = round(($sum_avg2 / $sum_avg1) * 100, 3);
		
		echo "Увеличение скорости $speed % <br>";
	}





	public static function Deb(...$mass)
	{
		echo "<pre>";
			print_r($mass);
		//	print_r(debug_backtrace());
		echo "</pre>";
	}

	public static function TimeFunc($nameFunc, $it = 50)
	{
		ob_start(); //Запускаем буферизауию вывода	
		$max = 0;
		$min = PHP_INT_MAX;
		$sum = 0;
		for ($i = 1; $i < $it; $i++)
		{
			$start = microtime(true);
			$nameFunc();
			$end = microtime(true) - $start;
			$sum += $end;
			$max = $end < $max ? $max : $end;
			$min = $end < $min ? $end : $min;
		}
		$str = ob_get_contents(); //Записываем в переменную то, что в буфере, в данном случае не используется это значение
		$sum_avg = $sum / $it;
		ob_end_clean(); //Очищаем буфер
		return [$max, $min, $sum_avg];
	
	}
	
public static function SessCook(...$mass)
{
	unset($_SESSION['session']);
	$_SESSION['post'] = ['time' => microtime(true), 'mass' => $_POST];
	$_SESSION['get'] = ['time' => microtime(true), 'mass' => $_GET];
	$_SESSION['session'] = ['time' => microtime(true), 'mass' => $_SESSION];
	$_SESSION['COOKIE'] = ['time' => microtime(true), 'mass' => $_COOKIE];
	$_SESSION['mass'] = $mass;
	$_SESSION['source'] = debug_backtrace()[1];
}

public static function DebugAll(...$mass)
{
	unset($_SESSION['debug']);
	$debug['post'] = ['time' => microtime(true), 'mass' => $_POST];
	$debug['get'] = ['time' => microtime(true), 'mass' => $_GET];
	$debug['session'] = ['time' => microtime(true), 'mass' => $_SESSION];
	$debug['COOKIE'] = ['time' => microtime(true), 'mass' => $_COOKIE];
	$debug['mass'] = $mass;
	$debug['source'] = debug_backtrace()[1];
	$_SESSION['debug'] = $debug;
}
	
	
public static function SessCookClear()
{
	unset($_SESSION['debug']);

}

public static function WiewSessCook()
{
	self::Deb($_SESSION);
}
	
}
?>