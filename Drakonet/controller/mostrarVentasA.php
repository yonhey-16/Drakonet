<?php

    function cargarVentas(){

        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->mostrarVentasA();

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo)) {
          echo '<h2>No hay ventas registradas en el sistema</h2>';
        } else {
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID factura</th>
                      <th>Fecha compra</th>
                      <th>Nombres empleado</th>  
                      <th>Nombres cliente</th>
                      <th>Forma de pago</th>
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
                    <td> '.$f["ID_factura"].' </td>
                    <td> '.$f["Fecha_compra"].' </td>
                    <td> '.$f["Nombres_empleado"].' </td>
                    <td> '.$f["Nombres_cliente"].' </td>
                    <td> '.$f["Nombre_forma_pago"].' </td>
                    <td> <a href="verInfoVenta.php?id_factura='.$f["ID_factura"].'" class="btn btn-success"> Ver/editar</a> </td>
                    <td> <a href="../../controller/eliminarVentasA.php?id_factura='.$f["ID_factura"].'" class="btn btn-danger"> eliminar</a> </td>
                </tr>
                ';
            }
            echo '
            </tbody>
                  <tfoot>
                    <tr>
                      <th>ID factura</th>
                      <th>Fecha compra</th>
                      <th>Nombres empleado</th>  
                      <th>Nombres cliente</th>
                      <th>Forma de pago</th>
                      <th>ver/editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                </table>
            ';

        }
    }
    function cargarInfoVenta(){

      $objetoConsultas = new consultasA();
      $id_factura = $_GET['id_factura'];
      $result = $objetoConsultas->buscarventa($id_factura);
  
      foreach ($result as $f){
        echo'
        <form action="../../controller/updateVentaA.php" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6" style="display: none">
                <label for="nombresImput">Id factura</label>
                <input type="text" name="id_factura" value="'.$f["ID_factura"].'" class="form-control" id="nombresImput" placeholder="Nombres completos">
              </div>
              <div class="form-group col-md-6">
                <label for="fechaImput">Fecha de la compra</label>
                <input type="date" name="nombres" value="'.$f["Fecha_compra"].'" class="form-control" id="fechaImput" placeholder="fecha">
              </div>
              <div class="form-group col-md-6">
                <label for="empeladoImput">Id del empleado</label>
                <input type="number" name="ID_empleado" value="'.$f["Nombres_empleado"].'" class="form-control" id="empleadoImput" placeholder="Apellidos completos">
              </div>
              <div class="form-group col-md-6">
                <label for="nombresImput">ID del cliente</label>
                <input type="number" name="ID_cliente" value="'.$f["Nombres_cliente"].'" class="form-control" id="nombresImput" placeholder="nombres de residencia">
              </div>
              <div class="form-group col-md-6">
                <label for="NombresImput">Id de la forma de pago</label>
                <input type="text" name="ID_forma_pago" value="'.$f["Nombre_forma_pago"].'" class="form-control" id="NombresImput" placeholder="Nombres">
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