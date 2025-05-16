<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    $Cod_producto = $_POST['Cod_producto'];
    $Nombre_Producto = $_POST['Nombre_Producto'];
    $Descripcion_producto = $_POST['Descripcion_producto'];
    $Caracteristicas_producto = $_POST['Caracteristicas_producto'];
    $ID_marca = $_POST['ID_marca'];
    $Nit_proveedor = $_POST['Nit_proveedor'];
    $Existencias_producto = $_POST['Existencias_producto'];
    $Precio_producto = $_POST['Precio_producto'];
    
    // validamos que todos los datos esten llenos
    if (!empty($Nombre_Producto) && !is_numeric($Nombre_Producto) && !preg_match("/[0-9]/", $Nombre_Producto) && !empty($Descripcion_producto) && !is_numeric($Descripcion_producto) && !preg_match("/[0-9]/", $Descripcion_producto) && !empty($Caracteristicas_producto) && is_numeric($Caracteristicas_producto) && strlen($Caracteristicas_producto) && !empty($ID_marca) && !is_numeric($ID_marca) && !preg_match("/[0-9]/", $ID_marca) && !empty($Nit_proveedor) && !is_numeric($Nit_proveedor) && !preg_match("/[0-9]/", $Nit_proveedor) && !empty($Existencias_producto) && !is_numeric($Existencias_producto) && !preg_match("/[0-9]/", $Existencias_producto) && !empty($Precio_producto) && !is_numeric($Precio_producto) && !preg_match("/[0-9]/", $Precio_producto)){              
            $objetoConsultas = new consultasA();
            $result = $objetoConsultas->updateProductoA($Cod_producto, $Nombre_Producto, $Descripcion_producto, $Caracteristicas_producto , $ID_marca , $Nit_proveedor, $Existencias_producto, $Precio_producto);

        
    } else{
        echo '<script> alert("Por favor complete todos los campos correctamente") </script>';
        echo "<script> window.history.back(); </script>";
    }
?>