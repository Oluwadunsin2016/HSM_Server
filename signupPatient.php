<?php 
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");
require_once('users.php');

$_POST=json_decode(file_get_contents("php://input"),true);

$surname=$_POST['surname'];
$full_name=$_POST['full_name'];
$email=$_POST['email'];
$gender=$_POST['gender'];
$address=$_POST['address'];
$phone_number=$_POST['phone_no'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$patients= new Users();
$result=$patients->registerPatient($surname,$full_name,$email,$gender,$address,$phone_number,$password);

echo json_encode($result);
?>