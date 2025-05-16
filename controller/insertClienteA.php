<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $clave = $_POST['celular'];
    $rol = 3;
    $estado = $_POST['estado'];
    
    // validamos que todos los datos esten llenos
    if (!empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres) && !empty($apellidos) && 
    !is_numeric($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) && !empty($celular) && 
    is_numeric($celular) && !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL) && !empty($direccion) && !empty($estado)){
        // validamos que las claves conduerden
        
            // encriptacion de clave
            $passmd = md5($clave);
            // convertimos la clase consultas  del modelo en un objeto
            $objetoConsultas = new consultasA();
            // enviamos los datos a la funcion registrar user perteneciente a la clase consultas e
            $result = $objetoConsultas->registrarCliente($nombres, $apellidos, $direccion, $email, $celular, $telefono, $rol, $estado, $passmd);

        
    } else{
        echo '<script> alert("Por favor revise que todos los campos esten bien diligenciados") </script>';
        echo "<script> window.history.back(); </script>";
    }
?>