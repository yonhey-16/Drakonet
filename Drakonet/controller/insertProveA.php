<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro

    $nitEmpresa = $_POST['nitProveedor'];
    $nombreEmpresa = $_POST['nombreEmpreProvee'];
    $telefonoEmpre = $_POST['telefonoEmpreProvee'];
    $direccionEmpre = $_POST['direccionEmpreProvee'];
    $nombreCont = $_POST['nombreContProvee'];
    $telefonoCont = $_POST['telefonoContProvee'];
    $correoCont = $_POST['correoContProvee'];

    
    // validamos que todos los datos esten llenos
    if (strlen($nitEmpresa)>0 && strlen($nombreEmpresa)>0 && strlen($telefonoEmpre)>0 && 
    strlen($direccionEmpre)>0 && strlen($nombreCont)>0 && strlen($telefonoCont)>0 && strlen($correoCont)>0){
        // validamos que las claves conduerden
            // convertimos la clase consultas  del modelo en un objeto
            $objetoConsultas = new consultasA();
            // enviamos los datos a la funcion registrar user perteneciente a la clase consultas e
            $result = $objetoConsultas->registrarProveedor($nitEmpresa, $nombreEmpresa, $telefonoEmpre, $direccionEmpre, $nombreCont, $telefonoCont, $correoCont);

        
    } else{
        echo '<script> alert("Por favor revise que todos los campos esten bien diligenciados") </script>';
        echo "<script> window.history.back(); </script>";
    }
?>