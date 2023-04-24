<?php 
header('Access-control-Allow-Origin:*');
header('Access-control-Allow-headers:Content-Type');
require_once('users.php');

$_POST=json_decode(file_get_contents('php://input'),true);
$id=$_POST['id'];

$outcome=new Users();
$result=$outcome->getParticularSpecialists($id);

echo json_encode($result)
?>