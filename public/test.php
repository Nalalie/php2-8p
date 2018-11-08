<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>

<?php
require_once('../lib/Debug.class.php');
Debug::WiewSessCook();
$count_goods = 11;

	
$data_product_guid = 123;
$basket[$data_product_guid] = 5;	
$basket[$data_product_guid] = $basket[$data_product_guid] + $count_goods;

$data_product_guid = 1234;	
$basket[$data_product_guid] = $basket[$data_product_guid] + $count_goods;	

Debug::Deb($basket);	
?>

</body>
</html>