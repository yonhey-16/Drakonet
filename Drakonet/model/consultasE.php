<?php
    class consultasE{
        //Modulo de clientes
        public function registarUser($nombres, $apellidos, $direccion, $email, $celular, $telefono, $rol, $estado, $passmd){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // selccionamos todo de la tabla clientes de la base de datos
            $sql = "SELECT * FROM clientes WHERE Correo_cliente = :email";
            $result = $conexion->prepare($sql);

            $result->bindParam(':email', $email);

            $result->execute();

            $f = $result->fetch();

            // si existe f quiere decir que ya hay un usuario con ese correo
            if ($f) {
                echo '<script> alert("Este usuario ya estan en el sistema, intente de nuevo") </script>';
                echo "<script> location.href='../view/client-side/register.php'</script>";
            } else {
                // Si no, insertamos los datos en la base de datos
                $sql = "INSERT INTO clientes (Nombres_cliente, Apellidos_cliente, Direccion_cliente, Correo_cliente, Celular_cliente, Telefono_fijo_cliente, ID_rol, ID_estado, Clave_cliente)
                VALUES (:nombres, :apellidos, :direccion, :email, :celular, :telefono, :rol, :estado, :passmd)";

                $statement = $conexion-> prepare($sql);

                $statement->bindParam(':nombres',$nombres);
                $statement->bindParam(':apellidos',$apellidos);
                $statement->bindParam(':direccion',$direccion);
                $statement->bindParam(':email',$email);
                $statement->bindParam(':celular',$celular);
                $statement->bindParam(':telefono',$telefono);
                $statement->bindParam(':rol',$rol);
                $statement->bindParam(':estado',$estado);
                $statement->bindParam(':passmd',$passmd);
                

                if(!$statement){
                    echo '<script> alert("Error en el sistema") </script>';
                    echo "<script> location.href='../view/client-side/register.php' </script>";
                } else {
                    $statement->execute();
                    echo '<script> alert("Registro Exitoso") </script>';
                    echo "<script> location.href='../view/client-side/login.php' </script>";
                }
            }
        }   
    }
?>