<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    $id_cliente = $_POST['id_cliente'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $rol = 3;
    $estado = $_POST['estado'];
    
    // validamos que todos los datos esten llenos
    if (!empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres) && !empty($apellidos) && !is_numeric($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) && !empty($celular) && is_numeric($celular) && strlen($celular) == 10 && !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL) && !empty($direccion) && !empty($estado)){       
        
            $objetoConsultas = new consultasA();
            $result = $objetoConsultas->updateClienteA($id_cliente, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $estado);

        
    } else{
        echo '<script> alert("Por favor complete todos los campos correctamente") </script>';
        echo "<script> window.history.back(); </script>";
    }
?>