<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>

  <div class="container-lg">
    <div>
      <h1 class="titulo" style="color: #93623c;text-align: center;">Departamentos Eliminados</h1>
    </div>
    <div class="card-body">       
        <a style="border-color: none;color: white;background-color: #93623c;"S href="<?php echo base_url('/departamentos'); ?>" class="btn regresar_Btn">Regresar</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped shadow p-3 mb-5 bg-body-tertiary rounded" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="color:#472f1c;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
            <th>Id</th>
            <th>Pais</th>
            <th>Nombre</th>
            <th style="width: 50px;">Estado</th>
            <th colspan="2">Acciones</th>
            </tr>
          </thead>
          <tbody style="font-family:Arial;font-size:12px;text-align: center;">
          <?php foreach ($departamentos as $dato) { ?>
              <tr>
              <td><?php echo $dato['id']; ?></td>
              <td><?php echo $dato['nombre_pais']; ?></td>
              <td><?php echo $dato['nombre']; ?></td>
              <td><?php echo $dato['estado']; ?></td>
              <td style="width: 70px;"><button type="button" class="btn btn-light"  data-href="<?php echo base_url('/departamentos/eliminar') . '/' .$dato['id']. '/' .'A'; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma"><i class="bi bi-arrow-repeat"></i></button></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      
      <!-- Modal Confirma Eliminar -->
      <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div style="text-align:center;" class="modal-header">
                    <h5 style="font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Activación de Registro</h5>
                    
                </div>
                <div style="text-align:center;font-weight:bold;" class="modal-body">
                    <p>Seguro Desea Activar éste Registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close" data-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>
    

</body>
<script>
    $('#modal-confirma').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  
  function eliminarDepartamento(id) {     
      $("#id").val(id);
      dataURL = "<?php echo base_url('eliminar_departamento'); ?>" + "/" + id + "/" + 'A';
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
        },
        error: function() {
                alert("No se ha Podido Activar El Registro");
            }
      })

  };
 
  $('.close').click(function() {$("#modal-confirma").modal("hide");});
</script>