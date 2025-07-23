<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card p-4 shadow" style="width: 350px;">
    <h3 class="mb-3 text-center">Iniciar Sesión</h3>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="nomusuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="nomusuario" name="nomusuario" required maxlength="15" />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required />
      </div>
      <button type="submit" class="btn btn-primary w-100">Entrar</button>
      <a href="registro.php" class="btn btn-link mt-2 d-block text-center">Crear cuenta</a>
    </form>
  </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
