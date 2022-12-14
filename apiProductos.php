<?php

class Api{

public function getProductos(){

    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "SELECT * FROM producto ORDER BY idproducto DESC LIMIT 20";
    $consulta = $db->prepare($sql);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    return $consulta;
   
}

public function getProductoById($id){

    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "SELECT u.id, p.idproducto, p.tipo_idtipo , p.estado FROM producto AS p INNER JOIN users AS u ON p.users_id = u.id WHERE u.id=".$id."";
    $consulta = $db->prepare($sql);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    return $consulta;
  
}

public function getProductoByN($nombres,$apellidos){

    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "SELECT u.id,u.nombres,u.apellidos,p.idproducto, p.tipo_idtipo , p.estado FROM producto AS p INNER JOIN users AS u ON p.users_id = u.id WHERE u.nombres=".$nombres." and u.apellidos=".$apellidos."";
    $consulta = $db->prepare($sql);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    return $consulta;
  
}



public function addProducto($id,$tipo_idtipo,$estado){
  
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "INSERT INTO proyecto.producto (users_id, tipo_idtipo,estado) VALUES (".$id.",".$tipo_idtipo.",'$estado')";
    $consulta = $db->prepare($sql);
    $consulta->execute();
    return $consulta;
}

public function deleteProducto($idproducto){
  
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "DELETE FROM producto WHERE idproducto=".$idproducto."";
    $consulta = $db->prepare($sql);
    $consulta->execute();
    return $consulta;

}

public function updateProducto($idproducto,$estado) {
  
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "UPDATE producto SET  estado='$estado' WHERE idproducto='$idproducto'";
    $consulta = $db->prepare($sql);
    $consulta->execute();

    return $consulta;
}


}

?>