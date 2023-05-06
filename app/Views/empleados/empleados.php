<head>
  <link rel="stylesheet" href="<?php echo base_url('/css/vistas copy 4.css'); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="<?php echo base_url(); ?>/css/jquery-3.6.0.js"></script>
</head>

<body>
  <div class="container-lg">
    <h1 class="titulo"><?php echo "Empleados"; ?></h1>

    <div class="botones">
      <button type="button" class="btn agregar" data-bs-toggle="modal" data-bs-target="#empleadosModal_agregar" onclick="seleccionaEmpleados(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
      <a href="<?php echo base_url('eliminados_empleados'); ?>" class="btn btn-secondary regresar_Btn">Eliminados</a>
      <a href="<?php echo base_url('/principal'); ?>" class="btn regresar  regresar_btn">Regresar</a>

    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-sm table-striped shadow p-3 mb-5 bg-body-tertiary rounded" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr style="color:#342C6E;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th style="width: 150px;">Año de Nacimiento</th>
            <th style="width: 90px;">Pais</th>
            <th>Departamento</th>
            <th>Municipio</th>
            <th style="width: 50px;">Estado</th>
            <th style="width: 150px;" >Cargo</th>

            <th colspan="2">Acciones</th>
          </tr>
        </thead>
        <tbody style="font-family:Arial;font-size:12px;text-align: center;">
          <?php foreach ($empleados as $dato) { ?>
            <tr>
              <td><?php echo $dato['id']; ?></td>
              <td><?php echo $dato['nombres']; ?></td>
              <td><?php echo $dato['apellidos']; ?></td>
              <td><?php echo $dato['nacimiento']; ?></td>
              <td><?php echo $dato['nombrePais']; ?></td>
              <td><?php echo $dato['nombre_dpto']; ?></td>
              <td><?php echo $dato['nombreMuni']; ?></td>
              <td><?php echo $dato['estado']; ?></td>
              <td><?php echo $dato['nombreCargo']; ?></td>
              <td style="width: 70px;"><button type="button" class="btn btn-light"><i class="bi bi-pencil-square" id="btn_Guardar" data-bs-toggle="modal" data-bs-target="#empleadosModal_agregar" class="btn btn-light" onclick="seleccionaEmpleados(<?php echo $dato['id'] . ',' . 2 ?>);"></i></button></td>
              <td style="width: 70px;"><button type="button" class="btn btn-light" data-href="<?php echo base_url('/empleados/eliminar') . '/' . $dato['id'] . '/' . 'E'; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma"><i class="bi bi-trash3"></i></button></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- Modal -->
    <form method="POST" action="<?php echo base_url('/Empleados/insertar'); ?>" autocomplete="off">
      <div class="modal fade" id="empleadosModal_agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="empleadosModal_agregar">Agregar Empleados</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="exampleDataList" class="form-label"></label>
              <input class="form-control" list="datalistOptions" id="nombres" name="nombres" placeholder="Nombres">
              <label for="exampleDataList" class="form-label"></label>
              <input class="form-control" list="datalistOptions" id="apellidos" name="apellidos" placeholder="Apellidos">
              <label for="exampleDataList" class="form-label"></label>
              <input class="form-control" list="datalistOptions" id="nacimiento" name="nacimiento" placeholder="Año de Nacimiento" type="number">

              <label for="exampleDataList" class="form-label"></label>
              <select class="form-select" name="pais" id="pais">
                <option selected value="0">Selecciona un pais</option>
                <?php foreach ($paises as $dato) { ?>
                  <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre']; ?></option>
                <?php } ?>
              </select>
              <label for="exampleDataList" class="form-label"></label>
              <select class="form-select" name="departamento" id="departamento">
                <!-- <option id="dpto" selected>Selecciona un departamento</option> -->

              </select>
              <label for="exampleDataList" class="form-label"></label>
              <select class="form-select" name="municipio" id="municipio" >
                <!-- <option id="municipio" selected>Selecciona un Municipio</option> -->

              </select>

              <label for="exampleDataList" class="form-label"></label>
              <select class="form-select" name="cargos" id="cargos" >
                <!-- <option id="cargos" selected>Selecciona un cargo</option> -->
                <?php foreach ($cargos as $dato) { ?>
                  <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre']; ?></option>
                <?php } ?>
              </select>
              <input hidden id="tp" name="tp"></>
              <input hidden id="id" name="id"></>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" id="btn" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- Modal Confirma Eliminar -->
    <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div style="text-align:center;" class="modal-header">
            <h5 style="color:#93623c;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>

          </div>
          <div style="text-align:center;font-weight:bold;" class="modal-body">
            <p>Seguro Desea Eliminar éste Registro?</p>
          </div>
          <div class="modal-footer">
            <button type="button" type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
            <a class="btn btn-danger btn-ok">Si</a>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>
<script>
  $('#modal-confirma').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  function seleccionaEmpleados(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/empleados/buscar_Empleados'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {

          $("#tp").val(2);
          $("#id").val(id);
          $("#nombres").val(rs[0]['nombres']);
          $("#apellidos").val(rs[0]['apellidos']);
          $("#pais").val(rs[0]['id_pais']);
          $("#departamento").val(rs[0]['id_dpto']);
          $("#nacimiento").val(rs[0]['nacimiento']);
          // $("#btn_Guardar").text('Actualizar');
          $("#titulo").text('Actualizar Empleados');
          $("#empleadosModal_agregar").modal("show");
          $("#cargos").val(rs[0]['id_cargo']);
          // llenar_Select(rs[0]['id_pais'], "departamento", 0, "buscar_DepartamentosPais");


          mostrarPaisDptoMunicipio( rs[0]['id_municipio'] );

          // $("#municipio").val(rs[0]['id_municipio']);
          // llenar_Select(rs[0]['id_pais'],"departamento",rs[0]['id_dpto']);
        }
      })
    } else {
      $("#tp").val(1);
      // document.getElementById('exampleModalLabel').innerText = "Agregar Empleados";  
      $("#titulo").text('Agregar Empleados');
      $("#id").val(id);
      $("#nombres").val('');
      $("#apellidos").val('');
      $("#nacimiento").val('');
      $("#pais").val('0');
      $("#departamento").val('');
      $("#municipio").val('');
      // $("#municipio").val('Selecciona un Depatamento');
      // $("#codigo").val('');
      // $("#cargos").val('');
    }
  };



function mostrarPaisDptoMunicipio( idMuni ) {
  dataUrl="<?php echo base_url("municipios/buscarDptoPaisPorIdMuni") ?>" + '/' + idMuni
      $.ajax({
        url: dataUrl,
        type: 'POST',
        dataType: 'json',
        success: function(rs) {   
          for(let i = 0; i < rs.length; i++) {
            $("dpto").empty();
            $("municipio").empty();

            let idPais = rs[i]['iden_pais'];
            let nombrePais = rs[i]['nombre_pais'];
            $("#pais").val( idPais );
            
            let idDpto = rs[i]['iden_dpto'];
            let nombreDpto = rs[i]['nombre_dpto'];
            llenarSelect2('departamento', idDpto, nombreDpto)

            
            let idMunicipio = rs[i]['iden_muni'];
            let nombreMuni = rs[i]['nombre_muni'];
            llenarSelect2('municipio', idMunicipio, nombreMuni)

          }
        }
      })
}

function llenarSelect2(select, id, nombre ) {
  $(`#${select}`).append(`<option value="${id}">${nombre}</option>`)
}












  $("#pais").change(function() {
    pais = $(this).val();           
    llenar_Select(pais,"departamento",0, "buscar_DepartamentosPais")
  })


    $("#departamento").change(function() {
      departamento = $(this).val();    
      llenar_Select(departamento,"municipio",0, "buscar_MunicipioDepartamento")

    }) 





    function llenar_Select(id,name,id_sel, url){
      dataUrl="<?php echo base_url() ?>" + url + '/' + id
      $.ajax({
        url: dataUrl,
        type: 'POST',
        dataType: 'json',
        success: function(res) {   
          $('#'+name).empty()
           $('#'+name).append(`<option>Elija una opcion</option>`)
           for (let i = 0; i < res[0].length; i++) {
            let id = res[0][i]['id'];
            let nombre = res[0][i]['nombre'];          
             $('#'+name).append("<option value='"+id+"'>"+nombre+"</option>");
          } 
          if(id_sel!=0){$('#'+name).val(id_sel);}
          // departamentoMunicipio();
        }
      })
    }


    
</script>