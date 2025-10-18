<h2>Editar ítem #<?= $item['id'] ?> (venta #<?= $item['sale_id'] ?>)</h2>
<form method="post" action="<?= $base ?>/sale_items/update" class="form" 
      oninput="subtotal.value = (qty.valueAsNumber||0)*(unit_price.valueAsNumber||0)">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">
  <input type="hidden" name="sale_id" value="<?= $item['sale_id'] ?>">
  <label>Producto
    <select name="product_id" required>
      <?php foreach ($products as $p): ?>
        <option value="<?= $p['id'] ?>" <?= $p['id']==$item['product_id']?'selected':'' ?>>
          <?= htmlspecialchars($p['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Cantidad <input type="number" name="qty" id="qty" min="1" value="<?= htmlspecialchars($item['qty']) ?>" required></label>
  <label>Precio unitario <input type="number" name="unit_price" id="unit_price" step="0.01" min="0" value="<?= htmlspecialchars($item['unit_price']) ?>" required></label>
  <label>Subtotal <input type="number" name="subtotal" id="subtotal" step="0.01" min="0" value="<?= htmlspecialchars($item['subtotal']) ?>" readonly></label>
  <button class="btn">Actualizar</button>
</form>
<p><a class="btn" href="<?= $base ?>/sale_items?sale_id=<?= $item['sale_id'] ?>">Volver</a></p>
