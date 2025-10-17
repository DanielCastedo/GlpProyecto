<h2>Editar</h2>
<form method="post" action="{<?= '$base' ?>}/drivers/update" class="form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
<label>Name<input name="name" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required></label>
<label>Phone<input name="phone" value="<?= htmlspecialchars($item['phone'] ?? '') ?>" required></label>
<label>License<input name="license" value="<?= htmlspecialchars($item['license'] ?? '') ?>" required></label>
<label>Truck_id<input name="truck_id" value="<?= htmlspecialchars($item['truck_id'] ?? '') ?>" required></label>

  <button class="btn">Actualizar</button>
</form>
