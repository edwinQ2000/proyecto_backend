<?php

require_once('apiProductos.php');
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
        $obj = $api->getProductoById($id);
        $json = json_encode($obj -> fetchAll());
        echo $json;
        

    }elseif (isset($_GET['nombres']) and isset($_GET['apellidos'])) {
        
        $nombres = $_GET['nombres'];
        $apellidos = $_GET['apellidos'];
        $api = new Api();
        $obj = $api->getProductoByN($nombres,$apellidos);
        $json = json_encode($obj -> fetchAll());
        echo $json;
        
        
    }else {
      $vector = array();
      $api = new Api();
      $vector = $api->getProductos();
      $json = json_encode($vector);
      echo json_encode($vector->fetchAll());
    }
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $id=$data['id'];
    if (isset($id)) {
        
        $tipo_idtipo = $data['tipo_idtipo'];
        $estado = $data['estado'];
        $api = new Api();
        $json = $api->addProducto($id,$tipo_idtipo,$estado);
        echo json_encode($json);
        exit();
        

    }else {
        echo "no hay tipo de id valido";
    }
    
    
    
}

if ($method=="DELETE") {
    $json = null;
    $idproducto = $_REQUEST['idproducto'];
    $api = new Api();
    $json = $api->deleteProducto($idproducto);
    echo $json;
}

if ($method=="PUT") {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $idproducto = $data['idproducto'];
    $estado = $data['estado'];
    $api = new Api();
    $json = $api->updateProducto($idproducto,$estado);
    echo $json;
}


?>