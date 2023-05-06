<head>
  <link rel="stylesheet" href="<?php echo base_url('/css/vistas copy 4.css'); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="<?php echo base_url(); ?>/css/jquery-3.6.0.js"></script>
</head>

<body>
<div class="container-lg">
  <h1 class="titulo"><?php echo "Administrar Usuarios"; ?></h1>

      <div class="botones align-baseline">
        <button type="button" class="btn agregar" data-bs-toggle="modal" id="btn_Agregar" data-bs-target="#usuariosModal_Agregar" onclick="seleccionaUsuarios(<?php echo 1 . ',' . 1 ?>);" >Agregar</button>
        <a href="<?php echo base_url('eliminados_usuarios'); ?>"  class="btn btn-secondary regresar_Btn">Eliminados</a>
        <a href="<?php echo base_url('/principal');?>"class="btn regresar  regresar_btn">Regresar</a>
      </div>
    <div class="fondo">
        <div class="table-responsive ">
                  <table class="table table-bordered table-sm table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr style="color:#342C6E;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                              <th>Id</th>
                              <th>Nombre Usuario</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                              <th style="width: 50px;">Estado</th>
                              <th colspan="2">Acciones</th>
                          </tr>
                      </thead>
                      <tbody style="font-family:Arial;font-size:12px;text-align: center;">
                          <?php foreach ($usuarios as $dato) { ?>
                            <tr>
                                <td><?php echo $dato ['id'];?></td>
                                <td><?php echo $dato ['nombre_corto'];?></td>
                                <td><?php echo $dato ['nombres'];?></td>
                                <td><?php echo $dato ['apellidos'];?></td>
                                <td><?php echo $dato ['estado'];?></td>
                                <td style="width: 70px;"><button type="button" id="Guardar" data-bs-toggle="modal" data-bs-target="#usuariosModal_Agregar" class="btn btn-light" onclick="seleccionaUsuarios(<?php echo $dato['id'] . ',' . 2 ?>);"><i class="bi bi-pencil-square"></i></button></td>
                                <td style="width: 70px;"><button type="button" data-href="<?php echo base_url('/usuarios/eliminar') . '/' .$dato['id']. '/' .'E'; ?>"  data-bs-toggle="modal" data-bs-target="#modal-confirma" class="btn btn-light"><i class="bi bi-trash3"></i></button></td>
                              </tr>
                                <?php }?>
                      </tbody>
                  </table>
              </div>


    </div>  
    <!-- Modal -->
    <form method="POST" action="<?php echo base_url('/Usuarios/insertar'); ?>" autocomplete="off">
      <div class="modal fade" id="usuariosModal_Agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="titulo"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="exampleDataList" class="form-label">Código</label>
              <input  type="number" class="form-control" list="datalistOptions" id="codigo" name="codigo" placeholder="">
              <input hidden id="tp" name="tp">
              <input hidden id="id" name="id">
              <label for="exampleDataList" class="form-label">Nombre</label>
              <input class="form-control" list="datalistOptions" id="nombre" name="nombre" placeholder="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn regresar" id="btn_Guardar">Guardar</button>
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
                    <h5 style="color:#93623c;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>
                    
                </div>
                <div style="text-align:center;font-weight:bold;" class="modal-body">
                    <p>Seguro Desea Eliminar éste Registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok" >Si</a>
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

  function seleccionaUsuarios(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/usuarios/buscar_usuario'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {     
          $("#tp").val(2);  
          $("#id").val(id);
          $("#titulo").text('Actualizar Usuario');  
          $("#nombre_corto").val(rs[0]['nombre_corto']);
          $("#nombres").val(rs[0]['nombres']);
          $("#apellidos").val(rs[0]['apellidos']);
          $("#btn_Guardar").text('Actualizar');
          $("#paisModal_agregar").modal("show");
        }
      })
    }else{
      $("#tp").val(1);}
      $("#id").val(id);
      $("#titulo").text('Agregar usuario');
      $("#nombre_corto").val('');
      $("#nombres").val('');
      $("#apellidos").val('');   
      $("#btn_Guardar").text('Guardar');
      $("#codigo").val('');
      $("#nombre").val('');
  };
</script>
