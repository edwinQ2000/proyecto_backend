<?php

class Api{

public function getUsers(){

    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 20";
    $consulta = $db->prepare($sql);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    return $consulta;
   
}

public function getUserId($id){

    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "SELECT * FROM users WHERE id=".$id."";
    $consulta = $db->prepare($sql);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    return $consulta;
  
}

public function getUserN($nombres,$apellidos){

    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "SELECT * FROM users WHERE nombres=".$nombres." and apellidos=".$apellidos;
    $consulta = $db->prepare($sql);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    return $consulta;
  
}



public function addUsers($nombres,$apellidos,$email,$genero,$direccion){
  
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "INSERT INTO users (nombres, apellidos,email,genero,direccion) VALUES ('$nombres','$apellidos','$email','$genero','$direccion')";
    $consulta = $db->prepare($sql);
    $consulta->execute();
    return $consulta;
}

public function deleteUsers($id){
  
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "DELETE FROM users WHERE id='$id'";
    $consulta = $db->prepare($sql);
    $consulta->execute();
    return $consulta;

}

public function updateUsers($id, $nombres, $apellidos , $email ,$genero,$direccion) {
  
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $sql = "UPDATE users SET nombres='$nombres', apellidos='$apellidos',email='$email',genero='$genero',direccion='$direccion' WHERE id='$id'";
    $consulta = $db->prepare($sql);
    $consulta->execute();

    return $consulta;
}


}

?>