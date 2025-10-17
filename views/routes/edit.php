<h2>Editar</h2>
<form method="post" action="{<?= '$base' ?>}/routes/update" class="form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
<label>Name<input name="name" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required></label>
<label>Description<input name="description" value="<?= htmlspecialchars($item['description'] ?? '') ?>" required></label>

  <button class="btn">Actualizar</button>
</form>
