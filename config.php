<?php 
class Config{
public $host = "localhost";
public $username = "root";
public $password = "";
public $db = "Hospital_management_db";

public $connection;
public $response;

public function __construct()
{
  $this->connection=mysqli_connect($this->host,$this->username,$this->password,$this->db);
  if (!$this->connection) {
   echo "connection failed";
  }
}

function create($query,$binder){
$data = $this->connection->prepare($query);
$data->bind_param(...$binder);
$check=$data->execute();

if ($check) {
  $this->response=true;
}else{
  $this->response=false;
}
return $this->response;
}

function read($query,$binder){
$data = $this->connection->prepare($query);
if ($binder) {
$data->bind_param(...$binder);
}
$data->execute();
return mysqli_stmt_get_result($data);
}
}
?>