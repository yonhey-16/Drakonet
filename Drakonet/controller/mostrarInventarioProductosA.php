<?php

    function cargarInventario(){

        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->mostrarInventarioProductosA();

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo)) {
            echo '<h2>No hay registros de inventario en el sistema</h2>';
        } else {
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID Inventario</th>
                      <th>Cod Producto</th>
                      <th>Nombre Producto</th>
                      <th>Fecha</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Causas</th>
                      <th>Observaciones</th>
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
                    <td> '.$f["ID_inventario"].' </td>
                    <td> '.$f["ID_inventario"].' </td>
                    <td> '.$f["Nombre_producto"].' </td>
                    <td> '.$f["Fecha_inventario"].' </td>
                    <td> '.$f["Cantidad_inventario"].' </td>
                    <td> '.$f["Precio_inventario"].' </td>
                    <td> '.$f["Causas"].' </td>
                    <td> '.$f["Observaciones"].' </td>
                    <td> <a href="verInfoInventario.php?id_inventario='.$f["ID_inventario"].'" class="btn btn-success"> Ver/editar</a> </td>
                    <td> <a href="../../controller/eliminarInventarioA.php?id_inventario='.$f["ID_inventario"].'" class="btn btn-danger"> eliminar</a> </td>
                </tr>
                ';
            }
            echo '
            </tbody>
                  <tfoot>
                    <tr>
                      <th>ID Inventario</th>
                      <th>Cod Producto</th>
                      <th>Nombre Producto</th>
                      <th>Fecha</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Causas</th>
                      <th>Observaciones</th>
                      <th>ver/editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                </table>
            ';

        }
    }
    function cargarInfoInventario(){

      $objetoConsultas = new consultasA();
      $ID_inventario = $_GET['ID_inventario'];
      $result = $objetoConsultas->buscarInventario($ID_inventario);
  
      foreach ($result as $f){
        echo'
        <form action="../../controller/updateInventarioA.php" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6" style="display: none">
                <label for="nombresImput">Id del producto</label>
                <input type="text" name="ID_inventario" value="'.$f["ID_inventario"].'" class="form-control" id="nombresImput" placeholder="Nombres completos">
              </div>
              <div class="form-group col-md-6">
                <label for="nombresImput">Nombre del producto</label>
                <input type="text" name="nombres" value="'.$f["Cod_producto"].'" class="form-control" id="nombresImput" placeholder="Nombre de la empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="descripcionImput">Descripcion</label>
                <input type="text" name="descripcion" valued"'.$f["Nombre_producto"].'" class="form-control" id="descripcionImput" placeholder="Telefono empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="caracteristicasImput">Caracteristicas</label>
                <input type="text" name="caracteristicas" value="'.$f["Fecha_inventario"].'" class="form-control" id="caracteristicasImput" placeholder="Direccion de la empresa">
              </div>
              <div class="form-group col-md-6">
                <label for="NombreImput">Marca</label>
                <input type="text" name="nombre" value="'.$f["Cantidad_inventario"].'" class="form-control" id="nombreImput" placeholder="Nombre del proveedor">
              </div>
              <div class="form-group col-md-6">
                <label for="nombreImput">Nit del proveedor</label>
                <input type="text" name="nombre" value="'.$f["Precio_inventario"].'" class="form-control" id="nombreImput" placeholder="No. de celular">
              </div>
              <div class="form-group col-md-6">
                <label for="existenciasImput">Existencias</label>
                <input type="number" name="existencias" value="'.$f["Causas"].'" class="form-control" id="existenciasImput"Correo">
              </div>
              <div class="form-group col-md-6">
                <label for="precioImput">Precio</label>
                <input type="number" name="precio" value="'.$f["Observaciones"].'" class="form-control" id="precioImput"Correo">
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