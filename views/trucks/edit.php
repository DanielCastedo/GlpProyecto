<h2>Editar</h2>
<form method="post" action="{<?= '$base' ?>}/trucks/update" class="form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
<label>Plate<input name="plate" value="<?= htmlspecialchars($item['plate'] ?? '') ?>" required></label>
<label>Model<input name="model" value="<?= htmlspecialchars($item['model'] ?? '') ?>" required></label>
<label>Capacity_units<input name="capacity_units" value="<?= htmlspecialchars($item['capacity_units'] ?? '') ?>" required></label>

  <button class="btn">Actualizar</button>
</form>
