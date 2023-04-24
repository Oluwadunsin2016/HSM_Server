<?php

use GuzzleHttp\Psr7\Uri;
use JetBrains\PhpStorm\ArrayShape;

require_once('config.php');
class Users extends Config{
function registerPatient($surname,$full_name,$email,$gender,$address,$phone_number,$password){
$query="SELECT * FROM `patients_tb` WHERE email = ?";
$binder=array('s',$email);
$outcome=$this->read($query,$binder);
if ($outcome) {
   $result= mysqli_fetch_assoc($outcome);
if ($result) {
  return ["success"=>false,"user"=>$result,"message"=>"This email has already been used"];
}
else{
$query = "INSERT INTO `patients_tb`(`surname`,`full_name`,`email`,`gender`,`address`,`phone_number`,`password`) VALUES(?,?,?,?,?,?,?)";
$binder=array('sssssss', $surname,$full_name,$email,$gender,$address,$phone_number,$password);
$outcome=$this->create($query,$binder);
if ($outcome) {
   return ["success"=>$outcome,"message"=>"Saved successfully"];
}else{
   return ["success"=>$outcome,"message"=>"An error occurred"];
}
};
}
}

function loginPatient($email,$password){
$query="SELECT * FROM `patients_tb` WHERE email = ?";
$binder=array('s',$email);
$outcome=$this->read($query,$binder);
if ($outcome->num_rows>0) {
  $currentUser=$outcome->fetch_assoc();
  $passwordCorrect=password_verify($password,$currentUser['password']);
  if ($passwordCorrect) {
  return ["user"=>$currentUser,"success"=>true,"message"=>"Logged in successfully"];
  }else{
  return ["success"=>false,"message"=>"Incorrect password"];
  }
}else{
  return ["success"=>false,"message"=>"Incorrect email"];
}
}

function getPatients(){
$query="SELECT * FROM `patients_tb`";
$binder=[];
$result= $this->read($query,$binder);
if ($result) {
 $users= mysqli_fetch_all($result,MYSQLI_ASSOC);

  return ["Patients"=>$users,"success"=>true,"message"=>"Got the data"];
}else{
  return ["success"=>false,"message"=>"No User found"];
}
}

function uploadPatientImage($id,$url){
$query="UPDATE `patients_tb` SET picture=? WHERE id=?";
$binder=array('si',$url,$id);
$outcome=$this->create($query,$binder);
if ($outcome) {
$query="SELECT * FROM `patients_tb` WHERE id = ?";
$binder=array('i',$id);
$result=$this->read($query,$binder);
if ($result->num_rows>0) {
  $currentUser=$result->fetch_assoc();
  if ($currentUser) {
   return ["user"=>$currentUser,"success"=>true,"message"=>"Profile picture uploaded succcessfully."];
  }
}
}else{
return ["success"=>false,"message"=>"An error occurred while uploading profile picture"];
}
}

function registerDoctor($surname,$full_name,$email,$gender,$phone_number,$specialization,$password){
$query="SELECT * FROM `doctors_tb` WHERE email = ?";
$binder=array('s',$email);
$outcome=$this->read($query,$binder);
if ($outcome) {
   $result= mysqli_fetch_assoc($outcome);
if ($result) {
  return ["success"=>false,"user"=>$result,"message"=>"This email has already been used"];
}
else{
$query = "INSERT INTO `doctors_tb`(`surname`,`full_name`,`email`,`gender`,`phone_number`,`specialization_id`,`password`) VALUES(?,?,?,?,?,?,?)";
$binder=array('sssssis', $surname,$full_name,$email,$gender,$phone_number,$specialization,$password);
$outcome=$this->create($query,$binder);
if ($outcome) {
   return ["success"=>$outcome,"message"=>"Saved successfully"];
}else{
   return ["success"=>$outcome,"message"=>"An error occurred"];
}
};
}
}

function loginDoctor($email,$password){
$query="SELECT * FROM `doctors_tb` WHERE email = ?";
$binder=array('s',$email);
$outcome=$this->read($query,$binder);
if ($outcome->num_rows>0) {
  $currentUser=$outcome->fetch_assoc();
  $passwordCorrect=password_verify($password,$currentUser['password']);
  if ($passwordCorrect) {
  return ["user"=>$currentUser,"success"=>true,"message"=>"Logged in successfully"];
  }else{
  return ["success"=>false,"message"=>"Incorrect password"];
  }
}else{
  return ["success"=>false,"message"=>"Incorrect email"];
}
}

function getDoctors(){
$query="SELECT * FROM `doctors_tb`";
$binder=[];
$result= $this->read($query,$binder);
if ($result) {
 $users= mysqli_fetch_all($result,MYSQLI_ASSOC);

  return ["Doctors"=>$users,"success"=>true,"message"=>"Got the data"];
}else{
  return ["success"=>false,"message"=>"No User found"];
}
}

function uploadDoctorImage($id,$url){
$query="UPDATE `doctors_tb` SET picture=? WHERE id=?";
$binder=array('si',$url,$id);
$outcome=$this->create($query,$binder);
if ($outcome) {
$query="SELECT * FROM `doctors_tb` WHERE id = ?";
$binder=array('i',$id);
$result=$this->read($query,$binder);
if ($result->num_rows>0) {
  $currentUser=$result->fetch_assoc();
  if ($currentUser) {
   return ["user"=>$currentUser,"success"=>true,"message"=>"Profile picture uploaded succcessfully."];
  }
}
}else{
return ["success"=>false,"message"=>"An error occurred while uploading profile picture"];
}
}

function updateDoctorStatus($id,$status){
$query="UPDATE `doctors_tb` SET `availability`=? WHERE id=?";
$binder=array('si',$status,$id);
$outcome=$this->create($query,$binder);
if ($outcome) {
$query="SELECT * FROM `doctors_tb` WHERE id = ?";
$binder=array('i',$id);
$result=$this->read($query,$binder);
if ($result->num_rows>0) {
  $currentUser=$result->fetch_assoc();
  if ($currentUser) {
   return ["user"=>$currentUser,"success"=>true,"message"=>"Status updated succcessfully."];
  }
}
}else{
return ["success"=>false,"message"=>"An error occurred while updating your status. Please try again"];
}
}


function getSpecialists(){
$query="SELECT * FROM `specialization_tb`";
$binder=[];
$result= $this->read($query,$binder);
if ($result) {
 $users= mysqli_fetch_all($result,MYSQLI_ASSOC);

  return ["Specialist"=>$users,"success"=>true,"message"=>"Got the data"];
}else{
  return ["success"=>false,"message"=>"No User found"];
}
}

function getParticularSpecialists($id){
$query="SELECT * FROM `doctors_tb` WHERE `specialization_id` = ?";
$binder=array('i',$id);
$result=$this->read($query,$binder);
if ($result) {
 $users= mysqli_fetch_all($result,MYSQLI_ASSOC);

  return ["Specialist"=>$users,"success"=>true,"message"=>"Got the data"];
}else{
return ["success"=>false,"message"=>"No User found"];
}
}

function createAppointment($purpose,$description,$createdAt,$doctorId,$patientId){
$query = "INSERT INTO `appointment_tb`(`purpose`,`description`,`createdAt`,`doctor_id`,`patient_id`) VALUES(?,?,?,?,?)";
$binder=array('sssii', $purpose,$description,$createdAt,$doctorId,$patientId);
$outcome=$this->create($query,$binder);
if ($outcome) {
   return ["success"=>$outcome,"message"=>"Booked successfully"];
}else{
   return ["success"=>$outcome,"message"=>"An error occurred"];
}
}

function getAppointments($id){
$query="SELECT * FROM `appointment_tb` WHERE `doctor_id` = ?";
$binder=array('i',$id);
$result= $this->read($query,$binder);
if ($result) {
 $users= mysqli_fetch_all($result,MYSQLI_ASSOC);

  return ["appointments"=>$users,"success"=>true,"message"=>"Got the data"];
}else{
  return ["success"=>false,"message"=>"No appointment found"];
}
}
}
