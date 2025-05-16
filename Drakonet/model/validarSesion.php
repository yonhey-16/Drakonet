<?php
    class validarSesion{


        public function iniciarSesionEmp($emailE, $claveE){

            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //se busca el correo ingresado en el login
            $sql = "SELECT * FROM empleados WHERE Correo_empleado = :emailE";
            $result = $conexion->prepare($sql);
            $result->bindParam(":emailE", $emailE);
            $result->execute();

            // fetch se usa para convertir en arreglo 
            if ($f = $result->fetch()) {
                // comparamos las claves
                if ($claveE == $f['Clave_empleado']) {
                    // comparamos el estado
                    if ($f['ID_estado'] == 1) {

                        //variables de inicio de sesion
                        session_start();
                        $_SESSION['id'] = $f['ID_empleado'];
                        $_SESSION['rol'] = $f['ID_rol'];
                        $_SESSION['autenticacion'] = "SI";
                        
                        if ($f['ID_rol'] == 1) {
                            echo '<script> alert("Bienvenido administrador") </script>';
                            echo "<script> location.href='../view/administrador/homeAdmin.php' </script>"; 
                        }
                        if ($f['ID_rol'] == 2) {
                            echo '<script> alert("Bienvenido vendedor") </script>';
                            echo "<script> location.href='../view/vendedor/homeVende.php' </script>"; 
                        }

                    } else {
                        echo '<script> alert("Este cuenta esta inactiva o bloqueada, contacte al administrador") </script>';
                        echo "<script> window.history.back(); </script>"; 
                    }

                } else {
                    echo '<script> alert("La clave es incorrecta, por favor verifique los datos") </script>';
                    echo "<script> window.history.back(); </script>";
                }
            } else {
                echo '<script> alert("Este correo no esta registrado en el sistema") </script>';
                echo "<script> window.history.back(); </script>";
            }



        }
    }
?>