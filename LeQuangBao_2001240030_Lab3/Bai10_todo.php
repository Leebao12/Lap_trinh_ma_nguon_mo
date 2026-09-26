<?php
$file='todo.json';
if(!file_exists($file)){
    file_put_contents($file,'[]');
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $data=file_get_contents('php://input');
    file_put_contents($file,$data);
    echo json_encode(["status"=>"success"]);
    exit;
}
header('Content-Type: application/json');
echo file_get_contents($file);
?>