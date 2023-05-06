<head>
  <link rel="stylesheet" href="<?php echo base_url('/css/vistas copy 4.css'); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="<?php echo base_url(); ?>/css/jquery-3.6.0.js"></script>
</head>

<body>
  <div class="container-lg">
    <h1 class="titulo"><?php echo "Administrar Municipios"; ?></h1>
    <div class="botones">
        <button type="button" class="btn agregar" data-bs-toggle="modal" data-bs-target="#municipiosModal_agregar" onclick="seleccionaMunicipio(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
        <a href="<?php echo base_url('eliminados_municipios'); ?>"  class="btn btn-secondary regresar_Btn">Eliminados</a>
        <a href="<?php echo base_url('/principal');?>"class="btn regresar  regresar_btn">Regresar</a>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-sm table-striped shadow p-3 mb-5 bg-body-tertiary rounded" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="color:#342C6E;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
              <th>Id</th>
              <th>Nombre del Municipio</th>
              <th>Nombre de Departamento</th>
              <th>Nombre del Pais</th>
              <th style="width: 50px;">Estado</th>
              <th colspan="2">Acciones</th>
            </tr>
          </thead>
          <tbody style="font-family:Arial;font-size:12px;text-align: center;">
            <?php foreach ($municipios as $dato) { ?>
              <tr>
                <td><?php echo $dato ['id'];?></td>
                <td><?php echo $dato ['nombre'];?></td>
                <td><?php echo $dato ['nombre_departamento'];?></td>
                <td><?php echo $dato ['nombre_pais'];?></td>
                <td><?php echo $dato ['estado'];?></td>
                <td style="width: 70px;"><button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#municipiosModal_agregar" onclick="seleccionaMunicipio(<?php echo $dato['id'] . ',' . 2 ?>);"><i class="bi bi-pencil-square"></i></button></td>
                <td style="width: 70px;"><button type="button" class="btn btn-light" data-href="<?php echo base_url('/municipios/eliminar') . '/' .$dato['id']. '/' .'E'; ?>"  data-bs-toggle="modal" data-bs-target="#modal-confirma"><i class="bi bi-trash3"></i></button></td>                
              </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    <!-- Modal -->
    <form method="POST" action="<?php echo base_url('/municipios/insertar'); ?>" autocomplete="off">
      <div class="modal fade" id="municipiosModal_agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="municipiosModal_agregar">Agregar Municipios</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="exampleDataList" class="form-label"></label>
              <select class="form-select" name="pais" id="pais">
                <option selected>Selecciona un pais</option>
                <?php foreach ($paises as $dato) { ?>
                  <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre']; ?></option>
                <?php } ?>
              </select>
              <label for="exampleDataList" class="form-label"></label>
              <select class="form-select" name="departamento" id="departamento">
                <option  id="dpto" selected>Selecciona un departamento</option>

              </select>
              <label for="exampleDataList" class="form-label">Nombre</label>
              <input class="form-control" list="datalistOptions" id="nombre" name="nombre" placeholder="">
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
            <div  class="modal-content">
                <div style="text-align:center;" class="modal-header">
                    <h5 style="color:#93623c;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Cargo</h5>
                    
                </div>
                <div style="text-align:center;font-weight:bold;" class="modal-body">
                    <p>Seguro Desea Eliminar éste Cargo?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
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
  function seleccionaMunicipio(id, tp) {
    //  alert(tp)
    //  alert(id)
    if (tp == 2) {
      dataURL = "<?php echo base_url('/municipios/buscar_municipio'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          $("#tp").val(2);  
          $("#id").val(id);  
          $("#pais").val(rs[0]['id_pais']);
          $("#departamento").val(rs[0]['id_dpto']);
          $("#nombre").val(rs[0]['nombre']);
          $("#btn").text('Actualizar');
          $("#municipiosModal_agregar").modal("show");
          llenar_Select(rs[0]['id_pais'],"departamento",rs[0]['id_dpto']);
        }
      })
    } else { 
      $("#tp").val(1);
      $("#nombre").val('');     
      $("#btn_Guardar").text('Guardar');
      $("#pais").val("Selecciona un pais");  
      $("#dpto").text("Selecciona un dpto");   
      $("#btn").text('Agregar');   
    }
  };

  
  $("#pais").on('change', function() {
      pais = $("#pais").val();        
      llenar_Select(pais,"departamento",0)
    });

    function llenar_Select(id,name,id_sel){
      dataUrl="<?php echo base_url('buscar_DepartamentosPais') ?>" + '/' + id
      $.ajax({
        url: dataUrl,
        type: 'POST',
        dataType: 'json',
        success: function(res) {         
          $('#'+name).empty()
           for (let i = 0; i < res[0].length; i++) {
            let id = res[0][i]['id'];
            let nombre = res[0][i]['nombre'];          
             $('#'+name).append("<option value='"+id+"'>"+nombre+"</option>");
          } 
          if(id_sel!=0){$('#'+name).val(id_sel);}
        }
      })
    }

</script>