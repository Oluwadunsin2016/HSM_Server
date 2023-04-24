<?php 
header("Access-Control-Allow-Origin: *");
require_once('users.php');
$patients=new Users();
$result=$patients->getPatients();
echo json_encode($result)
?>