<?php
class galery_ajaxModel extends Model
{

	public $title;
	
	function __construct()
	{
		parent::__Construct();
		$this->title .= "Фотогаллерея";
	}
	

	
	function galery_ajax(int $nStart = 0, int $nEnd = 30)
	{

		if (!empty($_POST['OneFile']))
		{
			$result['download'] = $this->DownloadImage();
		}
		
		$sql = "Select * from galery ORDER BY view DESC limit $nStart,$nEnd";
		$result['galery'] = db::getInstance()->Select($sql);
		
		return $result;
	}



}

?>