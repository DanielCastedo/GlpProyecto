<h2>Editar Perfil</h2>
<form method="post" action="<?= $base ?>/profile/update" class="form">
  <label>Nombre
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
  </label>

  <label>Email
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
  </label>

  <label>Nueva contraseña (opcional)
    <input type="password" name="password" placeholder="********">
  </label>

  <button class="btn">Actualizar Perfil</button>
</form>
