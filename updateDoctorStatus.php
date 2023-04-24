<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
require_once('users.php');

$_POST=json_decode(file_get_contents('php://input'),true);
$id=$_POST['id'];
$status=$_POST['status'];

$patient=new Users();
$result=$patient->updateDoctorStatus($id,$status);

echo json_encode($result);
?>