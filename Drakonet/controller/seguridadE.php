<?php

    session_start();

    if (!isset($_SESSION['autenticacion'])) {
        echo '<script> alert("Debe iniciar sesion para ingresar") </script>';
        echo "<script> location.href='../client-side/login.php'</script>";
    }

    if ($_SESSION['rol'] != "1" && $_SESSION['rol'] != "2") {
        echo '<script> alert("Su rol no tiene acceso a esta interfaz") </script>';
        echo "<script> location.href='../client-side/login.php'</script>";
    }


?>