<?php

    function cargarProveedores(){
        //Se llaman los datos
        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->mostrarProveedores();

        //isset = Establecido
        //Lo que existe en result esta establecido?
        if (!isset($arreglo)) {
            echo '<h2>No hay proveedores registrados en el sistema</h2>';
        } else {
            //Vista resumen
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NIT</th>
                    <th>Nombre empresa</th>
                    <th>Telefono empresa</th>
                    <th>Direccion empresa</th>
                    <th>Nombre contacto</th>
                    <th>Telefono contacto</th>
                    <th>Correo contacto</th>
                    <th>Ver/Editar</th>
                    <th>Eliminar</th>
                  </tr>
                  </thead>
                  <tbody>
            ';
            //Se repiten los registros del arreglo f en las filas y columnas
            foreach ($arreglo as $f){
                echo '
                <tr>
                    <td> '.$f["Nit_proveedor"].'  </td>
                    <td> '.$f["Nombre_empresa_proveedor"].' </td>
                    <td> '.$f["Telefono_empresa_proveedor"].'  </td>
                    <td> '.$f["Direccion_empresa_proveedor"].'  </td>
                    <td> '.$f["Nombre_contacto"].'  </td>
                    <td> '.$f["Telefono_contacto"].'  </td>
                    <td> '.$f["Correo_contacto"].'  </td>
                    <td> <a href="verinfoproveedor.php?nit_proveedor='.$f["Nit_proveedor"].'" class="btn btn-success">Ver/Editar</a> </td>
                    <td> <a href="../../controller/eliminarProveedorA.php?nit_proveedor='.$f["Nit_proveedor"].'" class="btn btn-danger">Eliminar</a> </td>
                  </tr>
                ';
            }

            //Se trae la parte faltante de la tabla
            echo '
            
            </tbody>
                  <tfoot>
                  <tr>
                    <th>NIT</th>
                    <th>Nombre empresa</th>
                    <th>Telefono empresa</th>
                    <th>Direccion empresa</th>
                    <th>Nombre contacto</th>
                    <th>Telefono contacto</th>
                    <th>Correo contacto</th>
                    <th>Ver/Editar</th>
                    <th>Eliminar</th>
                  </tr>
                  </tfoot>
                </table>
            
            ';
            


        }
    }
    
    function cargarInfoProveedor(){

      $objetoConsultas = new consultasA();
      $nit_proveedor = $_GET['nit_proveedor'];
      $result = $objetoConsultas->buscarProveedor($nit_proveedor);
  
      foreach ($result as $f){
        echo'
        <form action="../../controller/updateProveedorA.php" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6" style="display: none">
                <label for="nombresImput">Nit del proveedor</label>
                <input type="text" name="Nit_proveedor" value="'.$f["Nit_proveedor"].'" class="form-control" id="nombresImput" placeholder="Nombres completos">
              </div>
              <div class="form-group col-md-6">
                <label for="nombresImput">Nombre de la empresa</label>
                <input type="text" name="nombres" value="'.$f["Nombre_empresa_proveedor"].'" class="form-control" id="nombresImput" placeholder="Nombre de la empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="telefonoImput">Telefono de la empresa</label>
                <input type="number" name="telefono" value="'.$f["Telefono_empresa_proveedor"].'" class="form-control" id="telefonoImput" placeholder="Telefono empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="direccionImput">Dirección</label>
                <input type="text" name="direccion" value="'.$f["Direccion_empresa_proveedor"].'" class="form-control" id="direccionImput" placeholder="Direccion de la empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="NombreImput">Nombre del proveedor</label>
                <input type="text" name="nombre" value="'.$f["Nombre_contacto"].'" class="form-control" id="nombreImput" placeholder="Nombre del proveedor">
              </div>
              <div class="form-group col-md-6">
                <label for="telefonoImput">Celular</label>
                <input type="number" name="celular" value="'.$f["Telefono_contacto"].'" class="form-control" id="telefonoImput" placeholder="No. de celular">
              </div>
              <div class="form-group col-md-6">
                <label for="correoImput">Telefono</label>
                <input type="email" name="email" value="'.$f["Correo_contacto"].'" class="form-control" id="correoImput"Correo">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Actualizar</button>
          </div>
        </form>
      ';
      }
    }


?>