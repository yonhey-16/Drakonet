<?php

    function cargarProductos(){

        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->mostrarProductosA();

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo)) {
            echo '<h2>No hay registros de productos en el sistema</h2>';
        } else {
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id producto</th>
                      <th>Nombre producto</th>
                      <th>Descripcion</th>
                      <th>Caracteristicas</th>
                      <th>Marca</th>
                      <th>Nit proveedor</th>
                      <th>Existencias</th>
                      <th>Precio</th>
                      <th>ver/editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>

            ';
            //ciclo para repetir los registros del arreglo f
            foreach ($arreglo as $f){
                echo '
                <tr>
                  <td> '.$f["Cod_producto"].' </td>
                  <td> '.$f["Nombre_producto"].' </td>
                  <td> '.$f["Descripcion_producto"].' </td>
                  <td> '.$f["Caracteristicas_producto"].' </td>
                  <td> '.$f["ID_marca"].' </td>
                  <td> '.$f["Nit_proveedor"].' </td>
                  <td> '.$f["Existencias_producto"].' </td>
                  <td> '.$f["Precio_producto"].' </td>
                  <td> <a href="verInfoProducto.php?Cod_producto='.$f["Cod_producto"].'" class="btn btn-success"> Ver/editar</a> </td>
                  <td> <a href="../../controller/eliminarProductoA.php?Cod_producto='.$f["Cod_producto"].'" class="btn btn-danger"> eliminar</a> </td>
                </tr>
                ';
            }
            echo '
            </tbody>
                  <tfoot>
                    <tr>
                      <th>Id producto</th>
                      <th>Nombre producto</th>
                      <th>Descripcion</th>
                      <th>Caracteristicas</th>
                      <th>Marca</th>
                      <th>Nit proveedor</th>
                      <th>Existencias</th>
                      <th>Precio</th>
                      <th>ver/editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                </table>
            ';

        }
    }
    function cargarInfoProducto(){

      $objetoConsultas = new consultasA();
      $Cod_producto = $_GET['Cod_producto'];
      $result = $objetoConsultas->buscarProducto($Cod_producto);
  
      foreach ($result as $f){
        echo'
        <form action="../../controller/updateProductoA.php" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6" style="display: none">
                <label for="nombresImput">Id del producto</label>
                <input type="text" name="Cod_producto" value="'.$f["Cod_producto"].'" class="form-control" id="nombresImput" placeholder="Nombres completos">
              </div>
              <div class="form-group col-md-6">
                <label for="nombresImput">Nombre del producto</label>
                <input type="text" name="nombres" value="'.$f["Nombre_Producto"].'" class="form-control" id="nombresImput" placeholder="Nombre de la empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="descripcionImput">Descripcion</label>
                <input type="text" name="descripcion" valued"'.$f["Descripcion_producto"].'" class="form-control" id="descripcionImput" placeholder="Telefono empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="caracteristicasImput">Caracteristicas</label>
                <input type="text" name="caracteristicas" value="'.$f["Caracteristicas_producto"].'" class="form-control" id="caracteristicasImput" placeholder="Direccion de la empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="NombreImput">Marca</label>
                <input type="text" name="nombre" value="'.$f["ID_marca"].'" class="form-control" id="nombreImput" placeholder="Nombre del proveedor">
              </div>
              <div class="form-group col-md-6">
                <label for="nombreImput">Nit del proveedor</label>
                <input type="text" name="nombre" value="'.$f["Nit_proveedor"].'" class="form-control" id="nombreImput" placeholder="No. de celular">
              </div>
              <div class="form-group col-md-6">
                <label for="existenciasImput">Existencias</label>
                <input type="number" name="existencias" value="'.$f["Existencias_producto"].'" class="form-control" id="existenciasImput"Correo">
              </div>
              <div class="form-group col-md-6">
                <label for="precioImput">Precio</label>
                <input type="number" name="precio" value="'.$f["Precio_producto"].'" class="form-control" id="precioImput"Correo">
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