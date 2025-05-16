<?php

    function cargarEmpleados(){

        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->mostrarEmpleadosA();

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo)) {
            echo '<h2>No hay empleados registrados en el sistema</h2>';
        } else {
            // el nombre de los campos de la tabla
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>No. de documento</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>correo</th>
                      <th>Celular</th>
                      <th>Rol</th>
                      <th>ver/editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>

            ';
            //ciclo para repetir los registros del arreglo f
            foreach ($arreglo as $f){
              // los datos de la tabla traidos de consultasA con la funcion mostrarEmpleadosA
                echo '
                <tr>
                    <td> '.$f["ID_empleado"].' </td>
                    <td> '.$f["Nro_documento_empleado"].' </td>
                    <td> '.$f["Nombres_empleado"].' </td>
                    <td> '.$f["Apellidos_empleado"].' </td>
                    <td> '.$f["Correo_empleado"].' </td>
                    <td> '.$f["Celular_empleado"].' </td>
                    <td> '.$f["Nombre_rol"].' </td>
                    <td> <a href="verInfoEmpleado.php?id_empleado='.$f["ID_empleado"].'" class="btn btn-success"> Ver/editar</a> </td>
                    <td> <a href="../../controller/eliminarEmpleadoA.php?id_empleado='.$f["ID_empleado"].'" class="btn btn-danger"> eliminar</a> </td>
                </tr>
                ';
            }
            // el nombre de los campos de la tabla
            echo '
            </tbody>
                  <tfoot>
                    <tr>
                    <th>Id empleado</th>
                    <th>No. de documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>correo</th>
                    <th>Celular</th>
                    <th>Rol</th>
                    <th>ver/editar</th>
                    <th>Eliminar</th>
                    </tr>
                  </tfoot>
                </table>
            ';

        }
    }

    function cargarInfoEmpleado(){

      $objetoConsultas = new consultasA();
      $id_empleado = $_GET['id_empleado'];
      $result = $objetoConsultas->buscarEmpleado($id_empleado);

      foreach ($result as $f){
        echo'
        <form action="../../controller/updateEmpleadoA.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6" style="display: none">
                      <label for="idEmpImput">ID_empleado</label>
                      <input type="number" name="id_empleado" value="'.$f["ID_empleado"].'" class="form-control" id="idEmpImput" placeholder="No. de docuemento">
                    </div>
                    <!-- a la opcion de "selciones una opcion" se le pone un valor vacio para que haga 
                    la comparacion en insertarUserA y no de error -->
                    <div class="form-group col-md-6">
                      <label for="tipoDocImput">Tipo de documento</label>
                      <select class="form-control" name="tipoDoc"  id="tipoDocImput" require>
                        <option value="'.$f["ID_tipo_documento"].'">'.$f["Nombre_tipo_documento"].' </option>
                        <option value="1">CC</option>
                        <option value="2">CE</option>
                        <option value="3">Pasaporte</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="documentoimput">No. Documento</label>
                      <input type="number" name="numDoc" readonly="readonly" value="'.$f["Nro_documento_empleado"].'" class="form-control" id="documentoimput" placeholder="No. de docuemento">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nombresImput">Nombres</label>
                      <input type="text" name="nombres" value="'.$f["Nombres_empleado"].'" class="form-control" id="nombresImput" placeholder="Nombres completos">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="apellidosImput">Apellidos</label>
                      <input type="text" name="apellidos" value="'.$f["Apellidos_empleado"].'" class="form-control" id="apellidosImput" placeholder="Apellidos completos">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="celularImput">Celular</label>
                      <input type="number" name="celular" value="'.$f["Celular_empleado"].'" class="form-control" id="celularImput" placeholder="No. de celular">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="telefonoImput">Teléfono</label> 
                      <input type="number" name="telefono" value="'.$f["Telefono_fijo_empleado"].'" class="form-control" id="telefonoImput" placeholder="No. teléfono fijo (opcional)">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="direccionImput">Dirección</label>
                      <input type="text" name="direccion" value="'.$f["Direccion_empleado"].'" class="form-control" id="direccionImput" placeholder="Dirección de residencia">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="emailImput">Email</label>
                      <input type="email" class="form-control" name="email" value="'.$f["Correo_empleado"].'" id="emailImput" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="epsImput">Eps</label>
                      <select class="form-control" name="eps" id="epsImput" require>
                        <option value="'.$f["ID_eps"].'">'.$f["Nombre_eps"].'</option>
                        <option value="1">Alian salud</option>
                        <option value="2">Cafam</option>
                        <option value="3">Compensar</option>
                        <option value="4">Confandi</option>
                        <option value="5">Famisanar</option>
                        <option value="6">Nueva Eps</option>
                        <option value="7">Salud total</option>
                        <option value="8">Sanitas</option>
                        <option value="9">Servicio ocidental</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cajaCompensacionImput">Caja Compensación</label>
                      <select class="form-control" name="cajaCompensacion" id="cajaCompensacionImput" require>
                        <option value="'.$f["ID_caja_compensacion"].'" >'.$f["Nombre_caja_compensacion"].'</option>
                        <option value="1">Cafam</option>
                        <option value="2">Cajasan</option>
                        <option value="3">Colsubsidio</option>
                        <option value="4">Concaja</option>
                        <option value="5">Confacundi</option>
                        <option value="6">Compensar</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="arlImput">ARL</label>
                      <select class="form-control" name="arl" id="arlImput" require>
                        <option value="'.$f["ID_arl"].'" >'.$f["Nombre_arl"].'</option>
                        <option value="1">Aurora</option>
                        <option value="2">Axa colpatria</option>
                        <option value="3">Colmena</option>
                        <option value="4">La equidad</option>
                        <option value="5">Liberty seguros</option>
                        <option value="6">Mapfre</option>
                        <option value="7">Positiva</option>
                        <option value="8">Seguros alfa</option>
                        <option value="9">Seguros bolivar</option>
                        <option value="10">Sura</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="fondoImput">Fondo de pensiones</label>
                      <select class="form-control" name="fondoPension" id="fondoImput" require>
                        <option value="'.$f["ID_fondo_pension"].'" >'.$f["Nombre_fondo_pension"].'</option>
                        <option value="1">Colfondos</option>
                        <option value="2">Colpensiones</option>
                        <option value="3">Old mutuak</option>
                        <option value="4">Porvenir</option>
                        <option value="5">Protección</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="generoImput">Genero</label>
                      <select class="form-control" name="genero" id="generoImput" require>
                        <option value="'.$f["ID_genero"].'" >'.$f["Nombre_genero"].'</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                        <option value="3">Otro</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="rolImput">Rol</label>
                      <select class="form-control" name="rol" id="rolImput" require>
                        <option value="'.$f["ID_rol"].'" >'.$f["Nombre_rol"].'</option>
                        <option value="1">Administrador</option>
                        <option value="2">Vendedor</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cargoImput">Estado</label>
                      <select class="form-control" name="estado" id="cargoImput" require>
                        <option value="'.$f["ID_estado"].'" >'.$f["Nombre_estado"].'</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        <option value="3">Pendiente</option>
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