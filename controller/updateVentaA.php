<?php
    // enlazamos las dependencias necesarias, conexion a la base de datos
    // y las consultas que realizaran el insert en la tabla
    require_once('../model/conexion.php');
    require_once('../model/consultasA.php');

    // capturamos en variables los valores enviados por el name 
    // a traves del metodo post del formulario del registro
    $ID_factura = $_POST['ID_factura'];
    $fecha_compra = $_POST['fecha_compra'];
    $ID_empleado = $_POST['ID_empleado'];
    $ID_cliente = $_POST['ID_cliente'];
    $ID_forma_pago = $_POST['ID_forma_pago'];
    
    // valIDamos que todos los datos esten llenos
    if (!empty($fecha_compra) && !is_numeric($fecha_compra) && !preg_match("/[0-9]/", $fecha_compra) && !empty($ID_empleado) && !is_numeric($ID_empleado) && !is_numeric($ID_empleado) && !preg_match("/[0-9]/", $ID_empleado) && !empty($ID_cliente) && !is_numeric($ID_cliente) && !is_numeric($ID_cliente) && !preg_match("/[0-9]/", $ID_cliente) && !empty($ID_forma_pago) && !is_numeric($ID_forma_pago) && !is_numeric($ID_forma_pago) && !preg_match("/[0-9]/", $ID_forma_pago)){       
        
            $objetoConsultas = new consultasA();
            $result = $objetoConsultas->updateVentaA($ID_factura, $Fecha_compra, $ID_empleado, $ID_cliente, $ID_forma_pago);

        
    } else{
        echo '<script> alert("Por favor complete todos los campos correctamente") </script>';
        echo "<script> window.history.back(); </script>";
    }
?>