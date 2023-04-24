<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-allow-Headers: Content-Type");
require_once('users.php');

$_POST=json_decode(file_get_contents('php://input'),true);

$email=$_POST['email'];
$password=$_POST['password'];
// $password=password_verify($_POST['password'],PASSWORD_DEFAULT);

$patient = new Users();
$result=$patient->loginPatient($email,$password);

echo json_encode($result);