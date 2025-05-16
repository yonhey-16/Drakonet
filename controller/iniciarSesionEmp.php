<?php

    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/validarSesion.php');

    $emailE=$_POST['emailE'];
    $claveE=md5($_POST['claveE']);

    $objetoConsultas = new validarSesion();
    //iniciarSesionEmp es la funcion de la clase validarSesion
    $result = $objetoConsultas->iniciarSesionEmp($emailE, $claveE);


?>