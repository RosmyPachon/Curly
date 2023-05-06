<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="stylesheet" href="<?php echo base_url('/css/header copy 3.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('/bootstrap/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <meta charset="utf-8" />
  <script src="<?php echo base_url('/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>/css/jquery-3.6.0.js"></script>
</head>

<header>
  <img src="<?php echo base_url('/img/hair.png'); ?>"></a>
  <div class="titulos">

    <h1 style="text-align: center; color: white"><?php echo $titulo; ?></h1>
    <h6 style="text-align: center; color: white"><?php echo $nombre; ?></h6 class="text-muted">

  </div>

  <a href="https://oferta.senasofiaplus.edu.co/sofia-oferta/"><img src="<?php echo base_url('/img/logo blanco.png'); ?>"></a>

</header>
<nav style="background-color: #93623c;" class="navbar navbar-expand-lg navbar-light  shadow p-3 mb-5 bg-body-tertiary rounded">
  <div class="mx-auto">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a type="button" style="background-color: #f3bb90;border-radius:8px; box-shadow: 0 0 10px rgba(0,0,0,0.3); margin: 0px 30px 0px;padding: 10px 20px; font-weight: bold;" class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-geo-alt">
            </i>
            Ubicacion
          </a>

          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo base_url('/paises'); ?>">Pais</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('/departamentos'); ?>">Departamento</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('/municipios'); ?>">Municipio</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a type="button" style="background-color: #f3bb90;border-radius:8px; box-shadow: 0 0 10px rgba(0,0,0,0.5); margin: 0px 30px 0px; padding: 10px 20px; font-weight: bold;" class="nav-link" href="<?php echo base_url('/cargos'); ?>" tabindex="-1"><i class="bi bi-people"></i> Cargos</a>
        </li>
        <li class="nav-item dropdown">
        <a type="button" style="background-color: #f3bb90;border-radius:8px; box-shadow: 0 0 10px rgba(0,0,0,0.5); margin: 0px 30px 0px; padding: 10px 20px; font-weight: bold;" class="nav-link" href="<?php echo base_url('/usuarios'); ?>" tabindex="-1"><i class="bi bi-people"></i> Usuarios</a>
        <li class="nav-item dropdown">
          <a type="button" style="background-color: #f3bb90;border-radius:8px; box-shadow: 0 0 10px rgba(0,0,0,0.5); margin: 0px 30px 0px; padding: 10px 20px; font-weight: bold;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person">
              </i>
              Empleados
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo base_url('/empleados'); ?>">Administrar</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('/salarios'); ?>">Salarios</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<body>

</body>