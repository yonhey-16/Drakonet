<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    
    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    // $idinventario = $_POST['idinventario'];
    $Cod_producto = $_POST['Cod_producto'];
    $Nombre_producto = $_POST['Nombre_producto'];
    $Descripcion_producto = $_POST['Descripcion_producto'];
    $Caracteristicas_producto = $_POST['Caracteristicas_producto']; 
    $ID_marca = $_POST['ID_marca'];
    $Nit_proveedor = $_POST['Nit_proveedor'];
    $Precio_producto = $_POST['Precio_producto']; 
    $Cantidad = $_POST['Cantidad']; 
    
    // validamos que todos los datos esten llenos
    if (!empty($Cod_producto)
    && !empty($Nombre_producto) 
    && !empty($Descripcion_producto) 
    && !empty($Caracteristicas_producto )
    && !empty($ID_marca)
    && !empty($Nit_proveedor)
    && !empty($Precio_producto) 
    && !empty($Cantidad)){
           
        // convertimos la clase consultasa del modelo en un objeto
        $objetoConsultas = new consultasA();
        $result = $objetoConsultas->registrarProductoA($Cod_producto, $Nombre_producto, $Descripcion_producto, $Caracteristicas_producto, $ID_marca, $Nit_proveedor, $Precio_producto, $Cantidad);

    } else {
        echo '<script> alert("Por favor complete todos los campos") </script>';
        echo "<script> window.history.back(); </script>";
    }

?>