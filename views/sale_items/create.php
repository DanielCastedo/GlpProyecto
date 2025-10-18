<h2>Agregar ítem a venta #<?= $sale_id ?></h2>
<form method="post" action="<?= $base ?>/sale_items/store" class="form" oninput="subtotal.value = (qty.valueAsNumber||0)*(unit_price.valueAsNumber||0)">
  <input type="hidden" name="sale_id" value="<?= $sale_id ?>">
  <label>Producto
    <select name="product_id" required>
      <option value="">-- seleccionar --</option>
      <?php foreach ($products as $p): ?>
        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Cantidad <input type="number" name="qty" id="qty" min="1" value="1" required></label>
  <label>Precio unitario <input type="number" name="unit_price" id="unit_price" step="0.01" min="0" required></label>
  <label>Subtotal <input type="number" name="subtotal" id="subtotal" step="0.01" min="0" readonly></label>
  <button class="btn">Guardar</button>
</form>
<p><a class="btn" href="<?= $base ?>/sale_items?sale_id=<?= $sale_id ?>">Volver</a></p>
