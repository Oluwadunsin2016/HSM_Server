<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:Content-Type');
require_once(__DIR__ . '/vendor/autoload.php');
// require_once('users.php');

$_POST=json_decode(file_get_contents('php://input'),true);
$image=$_POST['image'];

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance([
  'cloud' => [
    'cloud_name' => 'dz8elpgwn', 
    'api_key' => '156782862586173', 
    'api_secret' => 'D3l69bjUuZouVw2T5CNZg5jsP24'],
  'url' => [
    'secure' => true]]);

$outcome=(new UploadApi())->upload($image, [
  'folder' => 'php/Profile_Pictures/',]
);

  echo json_encode($outcome);
  ?>