<?php

class captcha
{
	
	
public static function image_captha()
{

	$captcha = self::generate_code();
	
	$_SESSION['captcha']=$captcha;

	self::img_code($captcha); // Выводим изображение	
}	
	
private function generate_code() 
{    
	$chars = 'abdefhknrstyz23456789'; // Задаем символы, используемые в капче.
	$length = rand(4, 7); // Задаем длину капчи, в нашем случае - от 4 до 7
	$numChars = strlen($chars); // Узнаем, сколько у нас задано символов
	$str = '';
	for ($i = 0; $i < $length; $i++) 
	{
		$str .= substr($chars, rand(1, $numChars) - 1, 1);
	} // Генерируем код

	return $str;
}	
	
	

// Пишем функцию генерации изображения
private function img_code($code) // $code - код нашей капчи, который мы укажем при вызове функции
{
	// Отправляем браузеру Header'ы
/*	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");                   
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");         
	header("Cache-Control: post-check=0, pre-check=0", false);           
	header("Pragma: no-cache");                                           
	header("Content-Type:image/png");
*/

	
	// Задаем фоны для капчи. Можете нарисовать свой и загрузить его в папку /img. Рекомендуемый размер - 150х70. Фонов может быть сколько угодно
	$img_arr = array(
			"1.png"
		);
	
	// Генерируем случайный фон для капчи
	$img_fn = $img_arr[rand(0, sizeof($img_arr)-1)];
	$im = imagecreatefrompng(img_dir . $img_fn); 	
	
	
	// Задание переменной окружения для GD
	putenv('GDFONTPATH=' . realpath(captcha_font));

	
	// Шрифты для капчи. Задавать можно сколько угодно, они будут выбираться случайно
	$font_arr = array();
	$font_arr[0]["fname"] = "/Pangolin-Regular.ttf";	// Имя шрифта.
	$font_arr[0]["size"] = rand(20, 30);				// Размер в pt
	$n = rand(0,sizeof($font_arr)-1);

	
	
	// Рисуем линии на подстилке
	self::random_line($im);
	


	// Накладываем текст капчи
	$x = rand(0, 35);
	$color = imagecolorallocate($im, rand(0, 200), 0, rand(0, 200)); // Опять случайный цвет. Уже для текста.	
	for($i = 0; $i < strlen($code); $i++) 
	{
		$x+= rand(15,25);
		$letter=substr($code, $i, 1);
		imagettftext ($im, $font_arr[$n]["size"], rand(2, 4), $x, rand(50, 55), $color, captcha_font . $font_arr[$n]["fname"], $letter);
	}

	// Опять линии, уже сверху текста
	self::random_line($im);	
	// Возвращаем получившееся изображение
	ImagePNG($im);
	ImageDestroy($im);
}	


private function random_line($im)
{	
	// Количество линий. Обратите внимание, что они накладываться будут дважды (за текстом и на текст). 	
	$linenum = rand(7, 10); 
	for ($i=0; $i<$linenum; $i++)
	{
		$color = imagecolorallocate($im, rand(0, 150), rand(0, 100), rand(0, 150)); // Случайный цвет c изображения
		imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
	}
	
	for ($i=0; $i<$linenum; $i++)
	{
		$color = imagecolorallocate($im, rand(0, 150), rand(0, 100), rand(0, 150)); // Случайный цвет c изображения
		imageline($im, rand(0, 150), rand(0, 70), rand(0, 150), rand(0, 70), $color);
	}		
	
	
}
	
	
}

?>