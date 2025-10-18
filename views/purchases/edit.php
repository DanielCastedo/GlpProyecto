<h2>Editar Compra #<?= $purchase['id'] ?></h2>

<form method="post" action="<?= $base ?>/purchases/update" class="form">
  <input type="hidden" name="id" value="<?= $purchase['id'] ?>">
  <label>Fecha <input type="date" name="date" value="<?= $purchase['date'] ?>"></label>
  <label>Proveedor <input type="text" name="supplier" value="<?= htmlspecialchars($purchase['supplier']) ?>"></label>

  <label>Chofer
    <select name="driver_id">
      <?php foreach ($drivers as $d): ?>
        <option value="<?= $d['id'] ?>" <?= $d['id']==$purchase['driver_id']?'selected':'' ?>><?= htmlspecialchars($d['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Camión
    <select name="truck_id">
      <?php foreach ($trucks as $t): ?>
        <option value="<?= $t['id'] ?>" <?= $t['id']==$purchase['truck_id']?'selected':'' ?>><?= htmlspecialchars($t['plate']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Estado
    <select name="status">
      <?php foreach (['draft','confirmed','cancelled'] as $s): ?>
        <option value="<?= $s ?>" <?= $s==$purchase['status']?'selected':'' ?>><?= ucfirst($s) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <button class="btn">Actualizar</button>
</form>

<hr>
<h3>Productos de la compra</h3>
<form method="post" action="<?= $base ?>/purchase_items/store" style="display:flex;gap:10px;align-items:center;">
  <input type="hidden" name="purchase_id" value="<?= $purchase['id'] ?>">
  <select name="product_id" required>
    <option value="">Producto</option>
    <?php foreach ($products as $p): ?>
      <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
    <?php endforeach; ?>
  </select>
  <input type="number" name="qty" placeholder="Cantidad" min="1" required>
  <input type="number" step="0.01" name="unit_cost" placeholder="Costo unitario" required>
  <button class="btn">Añadir</button>
</form>

<table>
  <thead>
    <tr>
      <th>Producto</th><th>Cantidad</th><th>Costo Unit.</th><th>Subtotal</th><th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($items as $it): ?>
    <tr>
      <td><?= htmlspecialchars($it['product_name']) ?></td>
      <td><?= $it['qty'] ?></td>
      <td><?= number_format($it['unit_cost'],2) ?></td>
      <td><?= number_format($it['subtotal'],2) ?></td>
      <td>
        <form method="post" action="<?= $base ?>/purchase_items/destroy">
          <input type="hidden" name="id" value="<?= $it['id'] ?>">
          <input type="hidden" name="purchase_id" value="<?= $purchase['id'] ?>">
          <button class="btn btn-danger">X</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<p><b>Total: </b><?= number_format($purchase['total'],2) ?></p>

<form method="post" action="<?= $base ?>/purchases/confirm">
  <input type="hidden" name="id" value="<?= $purchase['id'] ?>">
  <button class="btn">Confirmar compra y actualizar inventario</button>
</form>
