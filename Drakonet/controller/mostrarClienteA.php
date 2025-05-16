<?php
  function cargarCliente(){

    $objetoConsultas = new ConsultasA();
    $arreglo = $objetoConsultas->mostrarClientes();

    if (!isset($arreglo)) {
      echo '<h2>NO HAY CLIENTES REGISTRADOS EN EL SISTEMA</h2>';
    } else {
      echo '
        <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Direccion</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Telefono</th>
            <th>Estado</th>
            <th>Ver/Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
        ';

      foreach ($arreglo as $f) {
        echo'
        <tr>
          <td> '.$f["ID_cliente"].' </td>
          <td> '.$f["Nombres_cliente"].' </td>
          <td> '.$f["Apellidos_cliente"].' </td>
          <td> '.$f["Direccion_cliente"].' </td>
          <td> '.$f["Correo_cliente"].' </td>
          <td> '.$f["Celular_cliente"].' </td>
          <td> '.$f["Telefono_fijo_cliente"].' </td>
          <td> '.$f["Nombre_estado"].' </td>
          <td> <a href="verInfoCliente.php?id_cliente='.$f["ID_cliente"].'" class="btn btn-success">Ver/Editar</a> </td>
          <td> <a href="../../controller/eliminarClienteA.php?id_cliente='.$f["ID_cliente"].'" class="btn btn-danger">Eliminar</a> </td>
        </tr>
        ';
      }

      echo '
      </tbody>
      <tfoot>
        <tr>
          <th>Id</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Direccion</th>
          <th>Correo</th>
          <th>Celular</th>
          <th>Telefono</th>
          <th>Estado</th>
          <th>Ver/Editar</th>
          <th>Eliminar</th>
        </tr>
      </tfoot>
      </table>
      ';
    }
  }
  function cargarInfoCliente(){

    $objetoConsultas = new consultasA();
    $id_cliente = $_GET['id_cliente'];
    $result = $objetoConsultas->buscarCliente($id_cliente);

    foreach ($result as $f){
      echo'
      <form action="../../controller/updateClienteA.php" method="POST">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6" style="display: none">
              <label for="nombresImput">Id Cliente</label>
              <input type="text" name="id_cliente" value="'.$f["ID_cliente"].'" class="form-control" id="nombresImput" placeholder="Nombres completos">
            </div>
            <div class="form-group col-md-6">
              <label for="nombresImput">Nombres</label>
              <input type="text" name="nombres" value="'.$f["Nombres_cliente"].'" class="form-control" id="nombresImput" placeholder="Nombres completos">
            </div>
            <div class="form-group col-md-6">
              <label for="apellidosImput">Apellidos</label>
              <input type="text" name="apellidos" value="'.$f["Apellidos_cliente"].'" class="form-control" id="apellidosImput" placeholder="Apellidos completos">
            </div>
            <div class="form-group col-md-6">
              <label for="direccionImput">Dirección</label>
              <input type="text" name="direccion" value="'.$f["Direccion_cliente"].'" class="form-control" id="direccionImput" placeholder="Direccion de residencia">
            </div>
            <div class="form-group col-md-6">
              <label for="emailImput">Email</label>
              <input type="email" name="email" value="'.$f["Correo_cliente"].'" class="form-control" id="emailImput" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
              <label for="telefonoImput">Celular</label>
              <input type="number" name="celular" value="'.$f["Celular_cliente"].'" class="form-control" id="celularImput" placeholder="No. de celular">
            </div>
            <div class="form-group col-md-6">
              <label for="telefonoImput">Telefono</label>
              <input type="number" name="telefono" value="'.$f["Telefono_fijo_cliente"].'" class="form-control" id="telefonoImput" placeholder="No. de telefono fijo (opcional)">
            </div>
            <div class="form-group col-md-6">
              <label for="estadoImput">Estado</label>
              <select class="form-control" name="estado"  id="estadoImput">
                <option value="'.$f["ID_estado"].'" >'.$f["Nombre_estado"].'</option>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
                <option value="3">Bloqueado</option>
              </select>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    ';
    }
  }
?>