<?php

require_once('apiUsers.php');
require_once('conexion.php');
require_once('cors.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    if (!empty($_GET['id'])) {
        $obj = array();
        $id = $_GET['id'];
        $api = new Api();
        $obj = $api->getUserId($id);
        $json = json_encode($obj -> fetchAll());
        echo $json;
        

    }elseif (isset($_GET['nombres']) and isset($_GET['apellidos'])) {
        
        $nombres = $_GET['nombres'];
        $apellidos = $_GET['apellidos'];
        $api = new Api();
        $obj = $api->getUserN($nombres,$apellidos);
        $json = json_encode($obj -> fetchAll());
        echo $json;
        
        
    }else {
      $vector = array();
      $api = new Api();
      $vector = $api->getUsers();
      $json = json_encode($vector);
      echo json_encode($vector->fetchAll());
    }
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $nombres = $data['nombres'];
    $apellidos = $data['apellidos'];
    $email = $data['email'];
    $genero = $data['genero'];
    $direccion = $data['direccion'];
    $api = new Api();
    $json = $api->addUsers($nombres,$apellidos,$email,$genero,$direccion);
    echo json_encode($json);
    exit();
}

if ($method=="DELETE") {
    $json = null;
    $id = $_REQUEST['id'];
    $api = new Api();
    $json = $api->deleteUsers($id);
    echo $json;
}

if ($method=="PUT") {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $nombres = $data['nombres'];
    $apellidos = $data['apellidos'];
    $email = $data['email'];
    $genero = $data['genero'];
    $direccion = $data['direccion'];
    $api = new Api();
    $json = $api->updateUsers($id, $nombres, $apellidos,$email,$genero,$direccion);
    echo $json;
}

/*---
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="select * from users where id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }elseif(isset($_GET['nombres']) and isset($_GET['apellidos'])){
        $query="select * from users where nombres=".$_GET['nombres']." and apellidos=".$_GET['apellidos'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }else{
        $query="select * from users ORDER BY id DESC LIMIT 20";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    #header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombres=$_POST['nombres'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $genero=$_POST['genero'];
    $direccion=$_POST['direccion'];
    $query="insert into users(nombres, apellidos, email, genero, direccion) values ('$nombres','$apellidos','$email','$genero', '$direccion')";
    $queryAutoIncrement="select MAX(id) as id from users";

    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $nombres=$_POST['nombres'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $genero=$_POST['genero'];
    $direccion=$_POST['direccion'];
    $query="UPDATE users SET nombres='$nombres', apellidos='$apellidos', email='$email', genero='$genero', direccion='$direccion' WHERE id='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM users WHERE id='$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

---*/


?>