<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    $Nit_proveedor = $_POST['Nit_proveedor'];
    $Nombre_empresa_proveedor = $_POST['Nombre_empresa_proveedor'];
    $Telefono_empresa_proveedor = $_POST['Telefono_empresa_proveedor'];
    $Direccion_empresa_proveedor = $_POST['Direccion_empresa_proveedor'];
    $Nombre_contacto = $_POST['Nombre_contacto'];
    $Telefono_contacto = $_POST['Telefono_contacto'];
    $Correo_contacto = $_POST['Correo_contacto'];
    
    // validamos que todos los datos esten llenos
    if (!empty($Nombre_empresa_proveedor) && !is_numeric($Nombre_empresa_proveedor) && !preg_match("/[0-9]/", $Nombre_empresa_proveedor) && !empty($Telefono_empresa_proveedor) && !is_numeric($Telefono_empresa_proveedor) && !preg_match("/[0-9]/", $Telefono_empresa_proveedor) && !empty($Direccion_empresa_proveedor) && is_numeric($Direccion_empresa_proveedor) && strlen($Direccion_empresa_proveedor) && !empty($Nombre_contacto) && !is_numeric($Nombre_contacto) && !preg_match("/[0-9]/", $Nombre_contacto) && !empty($Telefono_contacto) && !is_numeric($Telefono_contacto) && !preg_match("/[0-9]/", $Telefono_contacto) == 10 && !empty($Correo_contacto) && filter_var($Correo_contacto,FILTER_VALIDATE_EMAIL)){              
            $objetoConsultas = new consultasA();
            $result = $objetoConsultas->updateProveedorA($Nit_proveedor, $Nombre_empresa_proveedor, $Telefono_empresa_proveedor, $Direccion_empresa_proveedor, $Nombre_contacto, $Telefono_contacto, $Correo_contacto);

        
    } else{
        echo '<script> alert("Por favor complete todos los campos correctamente") </script>';
        echo "<script> window.history.back(); </script>";
    }
?>