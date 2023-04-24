<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
require_once('users.php');

$_POST=json_decode(file_get_contents('php://input'),true);

$surname=$_POST['surname'];
$full_name=$_POST['full_name'];
$email=$_POST['email'];
$gender=$_POST['gender'];
$phone_number=$_POST['phone_no'];
$specialization=$_POST['specialization'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$register= new Users();
$result=$register->registerDoctor($surname,$full_name,$email,$gender,$phone_number,$specialization,$password);

echo json_encode($result);