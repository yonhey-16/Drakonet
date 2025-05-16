<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    $id_empleado = $_POST['id_empleado'];
    $tipoDoc = $_POST['tipoDoc'];
    $numDoc = $_POST['numDoc'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $telefono = $_POST['telefono'];
    $eps = $_POST['eps'];
    $cajaCompensacion = $_POST['cajaCompensacion'];
    $arl = $_POST['arl'];
    $fondoPension = $_POST['fondoPension'];
    $genero = $_POST['genero'];
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];

    if (empty($tipoDoc)) {
        echo '<script> alert("Por favor escoja un tipo de documento") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($numDoc) || !is_numeric($numDoc)) {
        echo '<script> alert("Por favor dijite un numero de documento valido \nRECUERDE: el numero de documento no debe contener letras") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($nombres) || is_numeric($nombres) || preg_match("/[0-9]/", $nombres) || !preg_match("/[a-z]/", $nombres)){
        echo '<script> alert("Por favor escriba un nombre valido \nRECUERDE: Los nombres no deben contener numeros") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/", $apellidos) || !preg_match("/[a-z]/", $apellidos)){
        echo '<script> alert("Por favor escriba unos apellidos validos \nRECUERDE: Los apellidos no deben contener numeros") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($celular) || strlen($celular) < 10 || !is_numeric($celular)){
        echo '<script> alert("Por favor escriba un numero de celular valido \nRECUERDE: el numero de celular debe tener 10 digitos") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($direccion)) {
        echo '<script> alert("Por favor escriba una dirección de residencia valida") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<script> alert("Por favor escriba un email valido") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($eps)){
        echo '<script> alert("Por favor escoja una eps") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($cajaCompensacion)){
        echo '<script> alert("Por favor escoja una caja de compensación") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($arl)){
        echo '<script> alert("Por favor escoja una arl") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($fondoPension)){
        echo '<script> alert("Por favor escoja un fondo de pensión") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($genero)){
        echo '<script> alert("Por favor escoja un genero") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($rol)){
        echo '<script> alert("Por favor escoja un rol") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (empty($estado)){
        echo '<script> alert("Por favor escoja el estado") </script>';
        echo "<script> window.history.back(); </script>";
    } else if (!empty($tipoDoc) && 
        !empty($numDoc) && is_numeric($numDoc) && 
        !empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres) && preg_match("/[a-z]/", $nombres) && 
        !empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) && preg_match("/[a-z]/", $apellidos) && 
        !empty($celular) && strlen($celular) == 10 && is_numeric($celular) && 
        !empty($direccion) && 
        !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && 
        !empty($eps) && !empty($cajaCompensacion) && !empty($arl) && !empty($fondoPension) && 
        !empty($genero) && !empty($rol) && !empty($estado)){
            
            $objetoConsultas = new consultasA();
            $result = $objetoConsultas->updateEmpleadosA($id_empleado, $tipoDoc, $numDoc, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $eps, $cajaCompensacion, $arl, $fondoPension, $genero, $rol, $estado);
        }
?>