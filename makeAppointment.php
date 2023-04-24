<?php 
header('Access-Control-Allow-Origin: *');
header('Access-control-Allow-Headers: Content-Type');
require_once('users.php');

$_POST=json_decode(file_get_contents('php://input'),true);
$purpose=$_POST['purpose'];
$description=$_POST['description'];
$doctorId=$_POST['doctorId'];
$patientId=$_POST['patientId'];
$createdAt=$_POST['createdAt'];

$appointment= new Users();
$result=$appointment->createAppointment($purpose,$description,$createdAt,$doctorId,$patientId);
echo json_encode($result)
?>