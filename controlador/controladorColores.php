<?php

include_once '../conexion/conexion.php';
$ncl = new NuclearFactory();

//AGREGAR
if($_POST){
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    $sql_agregar = "INSERT INTO colores (color,descripcion) VALUES(?,?)";
    $data_agregar = array($color,$descripcion);
    $ncl->execute($sql_agregar, $data_agregar);
    $ncl->con = null;
    // print_r($data_agregar) ;

    header('Location: ../vistas/colores.php');
}

//ELIMINAR O EDITAR
if($_GET){
    //ELIMINAR
    if(isset($_GET['id_eliminar'])){
        $id_eliminar = $_GET['id_eliminar'];
        
        $sql_eliminar = "DELETE FROM colores WHERE id=?";
        $data_eliminar = array($id_eliminar);
        $ncl->execute($sql_eliminar, $data_eliminar);
        $ncl->con = null;
        // print_r($data_eliminar);

        header('Location: ../vistas/colores.php');
        return;
    }

    //EDITAR
    $id = $_GET['id'];
    $color = $_GET['color'];
    $descripcion = $_GET['descripcion'];

    $sql_editar = "UPDATE colores SET color=?,descripcion=? WHERE id=?";
    $data_editar = array($color,$descripcion,$id);
    $ncl->execute($sql_editar, $data_editar);
    $ncl->con = null;
    // print_r($data_editar) ;

    header('Location: ../vistas/colores.php');
}

?>
