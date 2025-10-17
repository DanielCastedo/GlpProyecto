<h2>Editar</h2>
<form method="post" action="<?= $base ?>/products/update" class="form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
<label>Name<input name="name" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required></label>
<label>Sku<input name="sku" value="<?= htmlspecialchars($item['sku'] ?? '') ?>" required></label>
<label>Cylinder_weight_kg<input name="cylinder_weight_kg" value="<?= htmlspecialchars($item['cylinder_weight_kg'] ?? '') ?>" required></label>
<label>Price<input name="price" value="<?= htmlspecialchars($item['price'] ?? '') ?>" required></label>

  <button class="btn">Actualizar</button>
</form>
