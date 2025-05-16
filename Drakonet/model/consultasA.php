<?php
    class consultasA{
        // modulo de empleados 
        public function registarEmpleadoA($tipoDoc, $numDoc, $nombres, $apellidos, $celular, $telefono, $direccion, $email, $eps, $cajaCompensacion, $arl, $fondoPension, $genero, $rol, $estado, $passmd){
            //creamos el objeto de la clase conexion para conectaornos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // selccionamos todo de la tabla empleados donde el email o numero de documento sea
            // igual al ingresado el el formulario
            $sql = "SELECT * FROM empleados WHERE Nro_documento_empleado=:numDoc OR Correo_empleado = :email";
            $result = $conexion->prepare($sql);

            $result->bindParam(':numDoc',$numDoc);
            $result->bindParam(':email',$email);

            $result->execute();

            //para almacenar la  result en la variable $f
            $f = $result->fetch();
            
            // si existe f quiere decir que ya hay un usuario con ese documento o ese correo
            if ($f) {
                echo '<script> alert("Este usuario ya estan en el sistema, intente de nuevo") </script>';
                echo "<script> window.history.back(); </script>";
            } else{
                // Si no, insertamos los datos en la base de datos
                $sql = "INSERT INTO empleados (ID_tipo_documento,
                 Nro_documento_empleado,
                  Nombres_empleado,
                   Apellidos_empleado,
                    Direccion_empleado,
                     Correo_empleado,
                      Celular_empleado,
                       Telefono_fijo_empleado, 
                       ID_eps, 
                       ID_caja_compensacion, ID_arl,
                ID_fondo_pension,
                 ID_genero,
                  ID_rol,
                   ID_estado,
                    clave_empleado)
                VALUES (:tipoDoc, :numDoc, :nombres, :apellidos, :direccion, :email, :celular, :telefono, :eps, :cajaCompensacion, :arl, :fondoPension, :genero, :rol, :estado, :passmd)";

                $statement = $conexion-> prepare($sql);

                $statement->bindParam(':tipoDoc',$tipoDoc);
                $statement->bindParam(':numDoc',$numDoc);
                $statement->bindParam(':nombres',$nombres);
                $statement->bindParam(':apellidos',$apellidos);
                $statement->bindParam(':celular',$celular);
                $statement->bindParam(':telefono',$telefono);
                $statement->bindParam(':direccion',$direccion);
                $statement->bindParam(':email',$email);
                $statement->bindParam(':eps',$eps);
                $statement->bindParam(':cajaCompensacion',$cajaCompensacion);
                $statement->bindParam(':arl',$arl);
                $statement->bindParam(':fondoPension',$fondoPension);
                $statement->bindParam(':genero',$genero);
                $statement->bindParam(':rol',$rol);
                $statement->bindParam(':estado',$estado);
                $statement->bindParam(':passmd',$passmd);
                

                if(!$statement){
                    echo '<script> alert("Error en el sistema") </script>';
                    echo "<script> location.href='../view/client-side/register.php' </script>";
                } else {
                    $statement->execute();
                    echo '<script> alert("Registro Exitoso") </script>';
                    echo "<script> location.href='../view/administrador/registrarEmpleado.php'</script>";
                }
            }  
        }
        public function mostrarEmpleadosA(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la tabla empleados
            $consultar = "SELECT e.*, r.* FROM empleados e, roles r WHERE e.ID_rol = r.ID_rol";
            $result = $conexion->prepare($consultar);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        public function buscarEmpleado($id_empleado){

            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT e.*, t.*, p.*, c.*, a.*, f.*, g.*, r.*, b.* FROM empleados e, tipo_documentos t, eps p, cajas_compensacion c, arl a, fondos_pension f, generos g, roles r, estados b 
            WHERE e.ID_empleado = :id_empleado AND t.ID_tipo_documento = e.ID_tipo_documento AND p.ID_eps = e.ID_eps 
            AND c.ID_caja_compensacion = e.ID_caja_compensacion AND a.ID_arl = e.ID_arl AND f.ID_fondo_pension = e.ID_fondo_pension 
            AND g.ID_genero = e.ID_genero AND e.ID_rol = r.ID_rol AND b.ID_estado = e.ID_estado";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':id_empleado', $id_empleado);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        public function updateEmpleadosA($id_empleado, $tipoDoc, $numDoc, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $eps, $cajaCompensacion, $arl, $fondoPension, $genero, $rol, $estado){
            
            //conexion con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // query para la actualizacion de los datos
            $actualizar = "UPDATE empleados SET ID_empleado = :id_empleado, ID_tipo_documento = :tipoDoc, Nro_documento_empleado = :numDoc, Nombres_empleado = :nombres, Apellidos_empleado = :apellidos, Celular_empleado = :celular, Telefono_fijo_empleado = :telefono, Direccion_empleado = :direccion, Correo_empleado = :email, ID_eps = :eps, ID_caja_compensacion = :cajaCompensacion, ID_arl = :arl, ID_fondo_pension = :fondoPension, ID_genero = :genero, ID_rol = :rol, ID_estado = :estado 
            WHERE ID_empleado=:id_empleado";

            $result = $conexion->prepare($actualizar);

            $result->bindParam(':id_empleado', $id_empleado);
            $result->bindParam(':tipoDoc', $tipoDoc);
            $result->bindParam(':numDoc', $numDoc);
            $result->bindParam(':nombres', $nombres);
            $result->bindParam(':apellidos', $apellidos);
            $result->bindParam(':direccion', $direccion);
            $result->bindParam(':email', $email);
            $result->bindParam(':celular', $celular);
            $result->bindParam(':telefono', $telefono);
            $result->bindParam(':eps', $eps);
            $result->bindParam(':cajaCompensacion', $cajaCompensacion);
            $result->bindParam(':arl', $arl);
            $result->bindParam(':fondoPension', $fondoPension);
            $result->bindParam(':genero', $genero);
            $result->bindParam(':rol', $rol);
            $result->bindParam(':estado', $estado);

            $result->execute();

            echo '<script> alert("Empleado actualizado") </script>';
            echo "<script> location.href='../view/administrador/verEmpleados.php'</script>";
        }
        public function eliminarEmpleadoA($id_empleado){
            $f = null;
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $eliminar = "DELETE FROM empleados WHERE ID_empleado = :id_empleado";
            $result = $conexion->prepare($eliminar);
            
            $result->bindParam(":id_empleado", $id_empleado);
            $result->execute();

            echo '<script> alert("Empleado eliminado") </script>';
            echo "<script> location.href='../view/administrador/verEmpleados.php' </script>";
        }
        
        // Modulo de proveedores 
        public function registrarProveedor($nitEmpresa, $nombreEmpresa, $telefonoEmpre, $direccionEmpre, $nombreCont, $telefonoCont, $correoCont){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //$sql = "SELECT * FROM users where identificacion=:numDoc OR email=:email";
            $sql = "SELECT * FROM proveedores WHERE Nit_proveedor = :nitProv OR Correo_contacto = :emailCont";
            
            $result = $conexion->prepare($sql);

            $result->bindParam(':nitProv',$nitEmpresa);
            $result->bindParam(':emailCont',$correoCont);
            $result->execute();

            $f = $result->fetch();

            if ($f) {
                echo '<script> alert("Este proveedor ya estan en el sistema, intente de nuevo") </script>';
                echo "<script> window.history.back(); </script>";
            } else{
                $sql = "INSERT INTO proveedores (Nit_proveedor, Nombre_empresa_proveedor, Telefono_empresa_proveedor, Direccion_empresa_proveedor, Nombre_contacto, Telefono_contacto, Correo_contacto)
                VALUES (:nitProv, :nombreEmpre, :teleEmpre, :direcEmpre, :nombCont, :teleCont, :emailCont)";
    
                $statement = $conexion-> prepare($sql);
                $statement->bindParam(':nitProv',$nitEmpresa);
                $statement->bindParam(':nombreEmpre',$nombreEmpresa);
                $statement->bindParam(':teleEmpre',$telefonoEmpre);
                $statement->bindParam(':direcEmpre',$direccionEmpre);
                $statement->bindParam(':nombCont',$nombreCont);
                $statement->bindParam(':teleCont',$telefonoCont);
                $statement->bindParam(':emailCont',$correoCont);
    
    
                if(!$statement){
                    echo '<script> alert("Error en el sistema") </script>';
                    echo "<script> location.href='../view/administrador/registrarProveedor.php' </script>";
                } else {
                    $statement->execute();
                    echo '<script> alert("Registro Exitoso") </script>';
                    echo "<script> location.href='../view/administrador/registrarProveedor.php' </script>";
                }
            }
        }
        public function mostrarProveedores(){
            $f = null;
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            //Se trae todo lo registrado en la base de datos.
            $consultar = "SELECT p.* FROM proveedores p WHERE p.Nit_proveedor = p.Nit_proveedor";
            //Se prepara la consulta
            $result = $conexion->prepare($consultar);
            //Ejecuta
            $result->execute();
        
        
                while ($arreglo = $result->fetch()) {
                    $f[] = $arreglo;
        
                }
                return $f;
        
        }
        public function buscarProveedor($nit_proveedor){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT p.* FROM proveedores p WHERE p.Nit_proveedor = :Nit_proveedor";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':Nit_proveedor', $nit_proveedor);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        public function updateProveedorA($Nit_proveedor, $Nombre_empresa_proveedor, $Telefono_empresa_proveedor, $Direccion_empresa_proveedor, $Nombre_contacto, $Telefono_contacto, $Correo_contacto){
            
            //conexion con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // query para la actualizacion de los datos
                                               //BD == variable
            $actualizar = "UPDATE proveedores SET Nit_proveedor = :Nit_proveedor, Nombre_empresa_proveedor = :Nombre_empresa_proveedor, Telefono_empresa_proveedor = :Telefono_empresa_proveedor, Direccion_empresa_proveedor = :Direccion_empresa_proveedor, Nombre_contacto = :Nombre_contacto, Telefono_contacto = :Telefono_contacto, Correo_contacto = :Correo_contacto
            WHERE Nit_proveedor=:Nit_proveedor";

            $result = $conexion->prepare($actualizar);

            $result->bindParam(':Nit_proveedor',$Nit_proveedor);
            $result->bindParam(':Nombre_empresa_proveedor',$Nombre_empresa_proveedor);
            $result->bindParam(':Telefono_empresa_proveedor',$Telefono_empresa_proveedor);
            $result->bindParam(':Direccion_empresa_proveedor',$Direccion_empresa_proveedor);
            $result->bindParam(':Nombre_contacto',$Nombre_contacto);
            $result->bindParam(':Telefono_contacto',$Telefono_contacto);
            $result->bindParam(':Correo_contacto',$Correo_contacto);
            $result->execute();

            echo '<script> alert("Proveedor actualizado correctamente") </script>';
            echo "<script> location.href='../view/administrador/verProveedores.php'</script>";

        }
        
        public function eliminarProveedor($nit_proveedor){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $eliminar = "DELETE FROM proveedores WHERE Nit_proveedor=:nit_proveedor";
            $result = $conexion->prepare($eliminar);
            $result->bindParam(":nit_proveedor", $nit_proveedor);

            $result->execute();
            echo '<script> alert("Eliminación exitosa") </script>';
            echo "<script> location.href='../view/administrador/verProveedores.php' </script>";
        }
        
        // Modulo de clientes
        public function registrarCliente($nombres, $apellidos, $direccion, $email, $celular, $telefono, $rol, $estado){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //$sql = "SELECT * FROM users where identificacion=:numDoc OR email=:email";
            
            $sql = "INSERT INTO clientes (Nombres_cliente, Apellidos_cliente, Direccion_cliente, Correo_cliente, Celular_cliente, Telefono_fijo_cliente, ID_rol, ID_estado)
            VALUES (:nombres, :apellidos, :direccion, :email, :celular, :telefono, :rol, :estado)";

            $statement = $conexion-> prepare($sql);

            $statement->bindParam(':nombres',$nombres);
            $statement->bindParam(':apellidos',$apellidos);
            $statement->bindParam(':direccion',$direccion);
            $statement->bindParam(':email',$email);
            $statement->bindParam(':celular',$celular);
            $statement->bindParam(':telefono',$telefono);
            $statement->bindParam(':rol',$rol);
            $statement->bindParam(':estado',$estado);
            

            if(!$statement){
                echo '<script> alert("Error en el sistema") </script>';
                echo "<script> location.href='../view/administrador/registrarCliente.php' </script>";
            } else {
                $statement->execute();
                echo '<script> alert("Registro Exitoso") </script>';
                echo "<script> location.href='../view/administrador/registrarCliente.php' </script>";
            }
        }
        public function mostrarClientes(){
            $f = null;
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $consultar = "SELECT c.*, e.* FROM clientes c, estados e WHERE c.ID_estado = e.ID_estado";
            
            $result = $conexion->prepare($consultar);
            $result->execute();

            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarCliente($id_cliente){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT c.*, e.* FROM clientes c, estados e 
            WHERE c.ID_cliente = :id_cliente AND c.ID_estado = e.ID_estado";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':id_cliente', $id_cliente);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        public function updateClienteA($id_cliente, $nombres, $apellidos, $direccion, $email, $celular, $telefono, $estado){
            
            //conexion con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // query para la actualizacion de los datos
            $actualizar = "UPDATE clientes SET ID_cliente = :id_cliente, Nombres_cliente = :nombres, Apellidos_cliente = :apellidos, Direccion_cliente = :direccion, Correo_cliente = :email, Celular_cliente = :celular, Telefono_fijo_cliente = :telefono, ID_estado = :estado 
            WHERE ID_cliente=:id_cliente";

            $result = $conexion->prepare($actualizar);

            $result->bindParam(':id_cliente',$id_cliente);
            $result->bindParam(':nombres',$nombres);
            $result->bindParam(':apellidos',$apellidos);
            $result->bindParam(':direccion',$direccion);
            $result->bindParam(':email',$email);
            $result->bindParam(':celular',$celular);
            $result->bindParam(':telefono',$telefono);
            $result->bindParam(':estado',$estado);

            $result->execute();

            echo '<script> alert("Cliente actualizado") </script>';
            echo "<script> location.href='../view/administrador/verCliente.php'</script>";

        }
        public function eliminarCliente($id_cliente){
            $f = null;

            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $eliminar = "DELETE FROM clientes WHERE ID_cliente=:id_cliente";
            $result = $conexion->prepare($eliminar);
            $result->bindparam(":id_cliente", $id_cliente);
            $result->execute();
            echo '<script> alert("Usuario Eliminado") </script>';
            echo "<script> location.href='../view/administrador/VerCliente.php' </script>";
        }
        
        // Modulo de Ventas
        public function registrarVenta($ID_empleado, $ID_cliente, $Cod_producto, $Cantidad_producto, $id_forma_pago){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $fecha = date('Y/m/d');
            $sql = "INSERT INTO facturas (Fecha_compra, ID_empleado, ID_cliente, ID_forma_pago)
            VALUES (:fecha, :ID_empleado, :ID_cliente, :id_forma_pago);";

            $statement = $conexion-> prepare($sql);

            // $statement->bindParam(':idfactura',$idfactura);
            $statement->bindParam(':fecha',$fecha);
            $statement->bindParam(':ID_empleado',$ID_empleado);
            $statement->bindParam(':ID_cliente',$ID_cliente);
            $statement->bindParam(':id_forma_pago',$id_forma_pago);
            

            if(!$statement){
                echo '<script> alert("Error en el sistema") </script>';
                echo "<script> location.href='../view/administrador/registrarVenta.php' </script>";
            } else {
                $statement->execute();
                echo '<script> alert("Registro Exitoso") </script>';
                echo "<script> location.href='../view/administrador/registrarVenta.php' </script>";
            }
        } 
        public function mostrarVentasA(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            $consultar = "SELECT F.ID_factura, f.Fecha_compra, E.Nombres_empleado, E.Apellidos_empleado, C.Nombres_cliente, C.Apellidos_cliente, FP.Nombre_forma_pago FROM facturas F JOIN empleados E ON E.ID_empleado = F.ID_empleado JOIN clientes C ON C.ID_cliente = F.ID_cliente 
            JOIN formas_pago FP ON FP.ID_forma_pago = F.ID_forma_pago ";
            $result = $conexion->prepare($consultar);
            $result->execute();
    
            //creamos un ciclo para convertir la variable result en arreglo $f
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarventa($id_factura){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT F.ID_factura, f.Fecha_compra, E.Nombres_empleado, E.Apellidos_empleado, C.Nombres_cliente, C.Apellidos_cliente, FP.Nombre_forma_pago FROM facturas F JOIN empleados E ON E.ID_empleado = F.ID_empleado JOIN clientes C ON C.ID_cliente = F.ID_cliente 
            JOIN formas_pago FP ON F.ID_forma_pago = :ID_factura";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':ID_factura', $id_factura);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        public function updateVentaA($ID_factura, $Fecha_compra, $ID_empleado, $ID_cliente, $ID_forma_pago){
            
            //conexion con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // query para la actualizacion de los datos
            $actualizar = "UPDATE facturas SET :factura = :ID_forma_pago, Fecha_compra = :fecha, ID_empleado = :empleado, ID_cliente = :cliente, ID_forma_pago = :pago 
            WHERE ID_factura = :factura";

            $result = $conexion->prepare($actualizar);

            $result->bindParam(':ID_factura',$ID_factura);
            $result->bindParam(':fecha_compra',$fecha_compra);
            $result->bindParam(':ID_empleado',$ID_empleado);
            $result->bindParam(':ID_cliente',$ID_cliente);
            $result->bindParam(':ID_forma_pago',$ID_forma_pago);

            $result->execute();

            echo '<script> alert("Venta actualizado") </script>';
            echo "<script> location.href='../view/administrador/verVenta.php'</script>";

        }
        public function eliminarVentasA($id_factura){
            $f = null;
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $eliminar = "DELETE FROM facturas WHERE ID_factura = :id_factura";
            $result = $conexion->prepare($eliminar);
            
            $result->bindParam(":id_factura", $id_factura);
            $result->execute();

            echo '<script> alert("Venta eliminada") </script>';
            echo "<script> location.href='../view/administrador/verVentas.php' </script>";
        }
        
        // Modulo de productos
        public function registrarProductoA($Cod_producto, $Nombre_producto, $Descripcion_producto, $Caracteristicas_producto, $ID_marca, $Nit_proveedor, $Precio_producto, $Cantidad){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "INSERT INTO productos (Cod_producto, Nombre_Producto, Descripcion_producto, Caracteristicas_producto , ID_marca , Nit_proveedor, Existencias_producto, Precio_producto)
            VALUES (:Cod_producto, :Nombre_producto, :Descripcion_producto, :Caracteristicas_producto, :ID_marca, :Nit_proveedor, :Cantidad, :Precio_producto)";

            $statement = $conexion-> prepare($sql);

            $statement->bindParam(':Cod_producto',$Cod_producto);
            $statement->bindParam(':Nombre_producto',$Nombre_producto);
            $statement->bindParam(':Descripcion_producto',$Descripcion_producto);
            $statement->bindParam(':Caracteristicas_producto',$Caracteristicas_producto);
            $statement->bindParam(':ID_marca',$ID_marca);
            $statement->bindParam(':Nit_proveedor',$Nit_proveedor);
            $statement->bindParam(':Precio_producto',$Precio_producto);
            $statement->bindParam(':Cantidad',$Cantidad);


            if(!$statement){
                echo '<script> alert("Error en el sistema") </script>';
                echo "<script> location.href='../view/administrador/registrarProductoA.php' </script>";
            } else {
                $statement->execute();
                echo '<script> alert("Registro Exitoso") </script>';
                echo "<script> location.href='../view/administrador/registrarProductoA.php' </script>";
            }
        } 
        public function mostrarProductosA(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            $consultar = "SELECT * FROM productos";
            $result = $conexion->prepare($consultar);
            $result->execute();
    
            //creamos un ciclo para convertir la variable result en arreglo $f
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarProducto($Cod_producto){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT p.*, r.* FROM Productos p, proveedores r WHERE p.Cod_producto = p.cod_producto AND p.Nit_proveedor = :Cod_producto";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':Cod_producto', $Cod_producto);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        public function updateproductoA($Cod_producto, $Nombre_Producto, $Descripcion_producto, $Caracteristicas_producto , $ID_marca , $Nit_proveedor, $Existencias_producto, $Precio_producto){
            
            //conexion con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // query para la actualizacion de los datos
            $actualizar = "UPDATE productos SET :Cod_producto, Nombre_Producto = :NomProducto, Descripcion_producto = :Descripcion, Caracteristicas_producto = :caracter, ID_marca = :marca, Nit_proveedor = :NitPro, Existencias_producto = :existencias, Precio_producto = :precio
            WHERE Cod_producto = :Cod_producto";

            $result = $conexion->prepare($actualizar);

            $result->bindParam(':Cod_producto',$Cod_producto);
            $result->bindParam(':Nombre_Producto',$Nombre_Producto);
            $result->bindParam(':Descripcion_producto',$Descripcion_producto);
            $result->bindParam(':Caracteristicas_producto',$Caracteristicas_producto);
            $result->bindParam(':ID_marca',$ID_marca);
            $result->bindParam(':Nit_proveedor',$Nit_proveedor);
            $result->bindParam(':Existencias_producto',$Existencias_producto);
            $result->bindParam(':Precio_producto',$Precio_producto);

            $result->execute();

            echo '<script> alert("Producto actualizado") </script>';
            echo "<script> location.href='../view/administrador/verProductosA.php'</script>";

        }
        public function eliminarProductosA($Cod_producto){
            $f = null;
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $eliminar = "DELETE FROM productos WHERE Cod_producto = :Cod_producto";
            $result = $conexion->prepare($eliminar);
            
            $result->bindParam(":Cod_producto", $Cod_producto);
            $result->execute();

            echo '<script> alert("Producto Eliminado exitosamente") </script>';
            echo "<script> location.href='../view/administrador/verProductosA.php' </script>";
        }
        
        // modulo de inventario de productos
        public function registrarInventarioProductos($nitproveedor, $codproducto, $nombreproducto, $fecha, $cantidad, $precio, $causa, $observacion){
            //creamos el objeto de la clase conexion
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "INSERT INTO inventario_productos (Nit_proveedor, Cod_producto, Nombre_producto, Fecha_inventario, Cantidad_inventario, Precio_inventario, Causas, Observaciones)
            VALUES (:nitproveedor, :codproducto, :nombreproducto, :fecha, :cantidad, :precio, :causa, :observacion)";

            $statement = $conexion-> prepare($sql);

            // $statement->bindParam(':idinventario',$idinventario);
            $statement->bindParam(':nitproveedor',$nitproveedor);
            $statement->bindParam(':codproducto',$codproducto);
            $statement->bindParam(':nombreproducto',$nombreproducto);
            $statement->bindParam(':fecha',$fecha);
            $statement->bindParam(':cantidad',$cantidad);
            $statement->bindParam(':precio',$precio);
            $statement->bindParam(':causa',$causa);
            $statement->bindParam(':observacion',$observacion);

            if(!$statement){
                echo '<script> alert("Error en el sistema") </script>';
                echo "<script> location.href='../view/administrador/registrarInventarioProductos.php' </script>";
            } else {
                $statement->execute();
                echo '<script> alert("Registro Exitoso") </script>';
                echo "<script> location.href='../view/administrador/registrarInventarioProductos.php' </script>";
            }
        } 
        public function mostrarInventarioProductosA(){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
    
            $consultar = "SELECT * FROM inventario_productos";
            $result = $conexion->prepare($consultar);
            $result->execute();
    
            //creamos un ciclo para convertir la variable result en arreglo $f
            while ($arreglo = $result->fetch()) {
                $f[] = $arreglo;
            }
            return $f;
        }
        public function buscarInventario($ID_inventario){
            $f = null;
            //creamos el objeto de la clase conexion para conectarnos a la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            //seleccionamos todo de la todas las tablas necesarias para poder mostrar el nombre en lugar del id
            $consultar = "SELECT i.*, r.*, c.* FROM inventario_productos i, proveedores r, productos c WHERE i.ID_inventario = i.ID_inventario AND i.Nit_proveedor = r.Nit_proveedor AND i.Cod_producto = :ID_inventario";
            $result = $conexion->prepare($consultar);
            $result->bindParam(':ID_inventario', $ID_inventario);
            $result->execute();

            //creamos un ciclo para convertir la variable result en arreglo
            //esto se ejecuta las veces que hayan registros
            while ($arreglo = $result->fetch()) {
                // la variable arreglo que contiene el arreglo, lo almacenamos en la varible f
                $f[] = $arreglo;
            }
            // retornamos f para poder mostrarlos en patalla mas adelante
            return $f;
        }
        public function updateInventarioA($ID_inventario, $Nit_proveedor, $Cod_producto, $Nombre_producto, $Fecha_inventario , $Cantidad_inventario , $Precio_inventario, $Causas, $Observaciones){
            
            //conexion con la base de datos
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            // query para la actualizacion de los datos
            $actualizar = "UPDATE productos SET ID_inventario = :ID_inventario, Nit_proveedor = :nit, Cod_producto = :codigo, Nombre_producto = :producto, Fecha_inventario = :fecha, Cantidad_inventario = :cantidad, Precio_inventario = :precio, Causas = :causas, Observaciones = :observaciones
            WHERE ID_inventario = :codigo";

            $result = $conexion->prepare($actualizar);

            $result->bindParam(':ID_inventario',$ID_inventario);
            $result->bindParam(':Nit_proveedor',$Nit_proveedor);
            $result->bindParam(':Cod_producto',$Cod_producto);
            $result->bindParam(':Nombre_producto',$Nombre_producto);
            $result->bindParam(':Fecha_inventario',$Fecha_inventario);
            $result->bindParam(':Cantidad_inventario',$Cantidad_inventario);
            $result->bindParam(':Precio_inventario',$Precio_inventario);
            $result->bindParam(':Causas',$Causas);
            $result->bindParam(':Observaciones',$Observaciones);

            $result->execute();

            echo '<script> alert("Inventario actualizado") </script>';
            echo "<script> location.href='../view/administrador/verInventarioProductos.php'</script>";

        }
        public function eliminarInventarioA($id_inventario){
            $f = null;
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            $eliminar = "DELETE FROM inventario_productos WHERE ID_inventario = :id_inventario";
            $result = $conexion->prepare($eliminar);
            
            $result->bindParam(":id_inventario", $id_inventario);
            $result->execute();

            echo '<script> alert("Eliminado") </script>';
            echo "<script> location.href='../view/administrador/verInventarioProductos.php' </script>";
        }

    }
?>