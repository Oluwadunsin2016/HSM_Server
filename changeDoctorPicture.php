<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
require_once('users.php');

$_POST=json_decode(file_get_contents('php://input'),true);
$id=$_POST['id'];
$url=$_POST['image'];

$patient=new Users();
$result=$patient->uploadDoctorImage($id,$url);

echo json_encode($result);
?>