<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #343a40, #212529); box-shadow: 0 4px 8px rgba(0,0,0,0.5);">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-warning d-flex align-items-center" href="http://localhost/sisventas">
      <i class="bi bi-house-door-fill me-2"></i> Home
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-semibold text-warning" href="#" id="navbarDropdownArchivos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-folder-fill"></i> Archivos
          </a>
          <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="navbarDropdownArchivos">
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/vista/producto/listado.php"><i class="bi bi-box-seam"></i> Productos</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/vista/cliente/listado.php"><i class="bi bi-people-fill"></i> Clientes</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/vista/proveedor/listado.php"><i class="bi bi-truck"></i> Proveedores</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/vista/categoria/productos_por_categoria.php"><i class="bi bi-tags-fill"></i> Categorías</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/vista/usuario/listado.php"><i class="bi bi-person-lines-fill"></i> Usuarios</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-door-closed-fill"></i> Terminar</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle fw-semibold text-warning" href="#" id="navbarDropdownProcesos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-gear-fill"></i> Procesos
  </a>
  <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="navbarDropdownProcesos">
    <li><a class="dropdown-item text-info" href="vista/procesos/registrar_venta.php"><i class="bi bi-receipt"></i> Registrar Ventas</a></li>
  </ul>
</li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-semibold text-warning" href="#" id="navbarDropdownConsultas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-search"></i> Consultas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="navbarDropdownConsultas">
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/consultas/stockProductos.php"><i class="bi bi-boxes"></i> Stock productos</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/consultas/ventas_por_dia.php"><i class="bi bi-calendar-day"></i> Ventas por día</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/consultas/ventas_por_fecha.php"><i class="bi bi-calendar-range"></i> Ventas por fecha</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/consultas/ventas_por_cliente.php"><i class="bi bi-person-check-fill"></i> Venta por Cliente</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/consultas/ventas_por_producto.php"><i class="bi bi-bag-check-fill"></i> Venta por producto</a></li>
            <li><a class="dropdown-item text-info" href="http://localhost/sisventas/consultas/ranking_ventas.php"><i class="bi bi-trophy-fill"></i> Ranking ventas</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-semibold text-warning" href="#" id="navbarDropdownHerramientas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-tools"></i> Herramientas
          </a>
          <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="navbarDropdownHerramientas">
            <li><a class="dropdown-item text-info" href="vista/usuario/cambiar_password.php"><i class="bi bi-key-fill"></i> Cambiar Password</a></li>
          </ul>
        </li>

        <?php if (isset($_SESSION['usuario'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-semibold text-warning" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['usuario']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark shadow" aria-labelledby="navbarDropdownUser">
              <li><a class="dropdown-item text-info" href="vista/panel.php"><i class="bi bi-speedometer2"></i> Panel</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-door-closed-fill"></i> Cerrar Sesión</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link fw-semibold text-warning" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold text-warning" href="registro.php"><i class="bi bi-person-plus-fill"></i> Registrarse</a></li>
        <?php endif; ?>

      </ul>

      <form class="d-flex align-items-center">
        <input class="form-control me-2 border-0 shadow-sm" style="background-color: #495057; color: white;" type="search" placeholder="Buscar..." aria-label="Buscar">
        <button class="btn btn-warning fw-bold" type="submit">
          <i class="bi bi-search"></i> Buscar
        </button>
      </form>
    </div>
  </div>
</nav>

