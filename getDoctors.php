<?php 
header("Access-Control-Allow-Origin: *");
require_once('users.php');
$response=new Users();
$result=$response->getDoctors();
echo json_encode($result)
?>