<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="card p-4 shadow" style="width: 450px;">
    <h3 class="mb-3 text-center">Registrar Usuario</h3>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="nomusuario" class="form-label">Usuario *</label>
        <input type="text" class="form-control" id="nomusuario" name="nomusuario" required maxlength="15" />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña *</label>
        <input type="password" class="form-control" id="password" name="password" required />
      </div>
      <div class="mb-3">
        <label for="password2" class="form-label">Confirmar Contraseña *</label>
        <input type="password" class="form-control" id="password2" name="password2" required />
      </div>
      <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="64" />
      </div>
      <div class="mb-3">
        <label for="nombres" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="nombres" name="nombres" maxlength="64" />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" maxlength="64" />
      </div>
      <button type="submit" class="btn btn-success w-100">Registrar</button>
      <a href="login.php" class="btn btn-link mt-2 d-block text-center">Ir a Iniciar Sesión</a>
    </form>
  </div>
</div>

<?php include __DIR__ . '/../layout/footer.php' ?>
