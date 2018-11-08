<?php

class RegisterController extends Controller
{
	
public $view = 'register';

	
public function index()
{
	$this->view .= "/" . __FUNCTION__ . '.php';
	echo $this->controller_view();				
}	
	

public function add()
{
Debug::SessCook();
	$this->view .= "/" . __FUNCTION__ . '.php';
	
	$data = [
	 	'login' => $_POST['login'],
        'pass' => $_POST['pass'],
        'pass2' => $_POST['pass2'],
        'surname' => $_POST['surname'],
        'name' => $_POST['name'],
        'patronymic' => $_POST['patronymic'],
        'telephone' => $_POST['telephone'],
        'email' => $_POST['email'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
        'comments' => $_POST['comments'],
        'sport' => $_POST['sport'],
        'turist' => $_POST['turist'],
        'padi' => $_POST['padi'],
        'travels' => $_POST['travels'],
        'auto' => $_POST['auto'],
        'it' => $_POST['it'],
	];
	
	echo $this->controller_view($data);	
	
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$surname = $_POST['surname'];
	$name = $_POST['name'];
	$patronymic = $_POST['patronymic'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$comments = $_POST['comments'];
	$sport = $_POST['sport'];
	$turist = $_POST['turist'];
	$padi = $_POST['padi'];
	$travels = $_POST['travels'];
	$auto = $_POST['auto'];
	$it = $_POST['it'];

}

	
	




}