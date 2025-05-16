<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    $ID_inventario = $_POST['ID_inventario'];
    $Nit_proveedor = $_POST['Nit_proveedor'];
    $Cod_producto = $_POST['Cod_producto'];
    $Nombre_producto = $_POST['Nombre_producto'];
    $Fecha_inventario = $_POST['Fecha_inventario'];
    $Cantidad_inventario = $_POST['Cantidad_inventario'];
    $Precio_inventario = $_POST['Precio_inventario'];
    $Causas = $_POST['Causas'];
    $Observaciones = $_POST['Observaciones'];
    
    // validamos que todos los datos esten llenos
    if (!empty($Nit_proveedor) && !is_numeric($Nit_proveedor) && !preg_match("/[0-9]/", $Nit_proveedor) && !empty($Cod_producto) && !is_numeric($Cod_producto) && !preg_match("/[0-9]/", $Cod_producto) && !empty($Nombre_producto) && !is_numeric($Nombre_producto) && !preg_match("/[0-9]/", $Nombre_producto) && !empty($Fecha_inventario) && is_numeric($Fecha_inventario) && strlen($Fecha_inventario) && !empty($Cantidad_inventario) && !is_numeric($Cantidad_inventario) && !preg_match("/[0-9]/", $Cantidad_inventario) && !empty($Precio_inventario) && !is_numeric($Precio_inventario) && !preg_match("/[0-9]/", $Precio_inventario) && !empty($Causas) && !is_numeric($Causas) && !preg_match("/[0-9]/", $Causas) && !empty($Observaciones) && !is_numeric($Observaciones) && !preg_match("/[0-9]/", $Observaciones)){              
            $objetoConsultas = new consultasA();
            $result = $objetoConsultas->updateInventarioA($ID_inventario, $Nit_proveedor, $Cod_producto, $Cod_producto, $Fecha_inventario , $Cantidad_inventario , $Precio_inventario, $Causas, $Observaciones);

        
    } else{
        echo '<script> alert("Por favor complete todos los campos correctamente") </script>';
        echo "<script> window.history.back(); </script>";
    }
?>