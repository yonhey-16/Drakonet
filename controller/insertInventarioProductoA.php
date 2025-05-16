<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');
    
    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    // $idinventario = $_POST['idinventario'];
    $nitproveedor = $_POST['nitproveedor'];
    $codproducto = $_POST['codproducto'];
    $nombreproducto = $_POST['nombreproducto'];
    $fecha = $_POST['fecha'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $causa = $_POST['causa'];
    $observacion = $_POST['observacion'];
    
    // validamos que todos los datos esten llenos
    if (strlen($nitproveedor)>0 && strlen($codproducto)>0 && strlen($nombreproducto)>0 && 
    strlen($fecha)>0 && strlen($cantidad)>0 && strlen($precio)>0 && strlen($observacion)>0 && strlen($causa)>0){
           
            // convertimos la clase consultasa del modelo en un objeto
            $objetoConsultas = new consultasA();
            $result = $objetoConsultas->registrarInventarioProductos($nitproveedor, $codproducto, $nombreproducto, $fecha, $cantidad, $precio, $causa, $observacion);

        }else{
            echo '<script> alert("Por favor revise que todos los campos esten bien diligenciados") </script>';
            echo "<script> window.history.back(); </script>";
    }

?>