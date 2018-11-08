<?php
class basketModel extends Model
{
	public $view = 'basket';
	public $title;
	
	function __construct()
	{
		parent::__Construct();
		$this->title .= "Корзина";
	}
	
	
	function index($data = NULL, $deep = 0)
	{
		$this->view .= "/" . __FUNCTION__ . '.php';
		$hash_cookie = $_SESSION['IdUserSession'];
		

		$sql['sql'] = "SELECT * FROM `goods` WHERE ID_UUID in (SELECT ID_UUID FROM `basket`WHERE id_user = (SELECT id_user FROM `users_auth` WHERE hash_cookie = :hash_cookie));";
		$sql['param'] = 
			[
				'hash_cookie' => $hash_cookie,
			];		
		$result['catalog'] = db::getInstance()->Select($sql['sql'], $sql['param']);
//		Debug::Deb($sql,$results,$result);

return $result;
	}


	
}

?>