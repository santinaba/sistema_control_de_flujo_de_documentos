<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Documentos</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/font-awesome.css">
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
  <link rel="shortcut icon" href="../public/img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet " type="text/css" href="../public/datatables/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/datatables/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="#" class="logo">
        <span class="logo-mini">Sistema de control de documentos</span>
        <span class="logo-lg"><b>Documentos</b></span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>
        <div class="navbar-custom-menu">
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu">
          <li class="header"></li>
          <li>
            <a href="#">
              <i class="fa fa-pie-chart"></i> <span>Estadistícas</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="estadistica_por_semana.php"><i class="fa fa-circle-o"></i> Estadística por Semana</a></li>
              <li><a href="estadistica_por_fechas.php"><i class="fa fa-circle-o"></i> Estadística por Fechas</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="documento.php">
              <i class="fa fa-list-ul"></i>
              <span>Listado</span>
            </a>
          </li>
          <li class="treeview">
            <a href="reporte.php">
              <i class="fa fa-file-text"></i>
              <span>Reporte</span>
            </a>
          </li>
        </ul>
      </section>
    </aside>