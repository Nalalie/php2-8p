<?php
class galeryModel extends Model
{

	public $title;
	
	function __construct()
	{
		parent::__Construct();
		$this->title .= "Фотогаллерея";
	}
	

	
	function galery(int $nStart = 0, int $nEnd = 30)
	{

		if (!empty($_POST['OneFile']))
		{
			$result['download'] = $this->DownloadImage();
		}
		
		$sql = "Select * from galery ORDER BY view DESC limit $nStart,$nEnd";
		$result['galery'] = db::getInstance()->Select($sql);
		
		return $result;
	}


protected function DownloadImage()
{

	$flag = false;
	$already_uploaded = false;
	if (empty($_FILES['myfile']['tmp_name'])) return ['already_uploaded' => $already_uploaded, 'flag' => $flag];
	
	
	$uploaddir = Config::get('UPLOAD_DIR');
	$uploaddsmalldir = Config::get('UPLOAD_SMALL_DIR');
	$my_hash_file = hash_file('md5', $_FILES['myfile']['tmp_name']). '.'. end(explode(".", $_FILES['myfile']['name']));
	$my_file_name = $_FILES['myfile']['name'];
	$destination = $uploaddir .'/' . $my_hash_file; 
	$destination_small = $uploaddsmalldir . $my_hash_file;
	
	if (file_exists($destination)) 
	{
		$sql = "SELECT * FROM `galery` WHERE hash_file = '$my_hash_file';";
		$result = db::getInstance()->Select($sql);
		if ($result)
		{
			$already_uploaded = true;
		}
	} 
	else 
	{
		if (move_uploaded_file($_FILES['myfile']['tmp_name'],$destination)) 
		{ 		
			$sql = "INSERT INTO `galery` (`id_galery`, `name_foto`, `hash_file`, `name_file`) VALUES (NULL, '$NameImg', '$my_hash_file', '$my_file_name')";
			db::getInstance()->Query($sql);
						
			resize::create_thumbnail($destination, $destination_small, 320, 320);
			$already_uploaded = false;
			$flag = true;
		} 
		else 
		{
			$flag = false;
		}
	}
	
	
	return ['already_uploaded' => $already_uploaded, 'flag' => $flag];
}

}

?>