<h2>Editar pago #<?= $item['id'] ?> (venta #<?= $item['sale_id'] ?>)</h2>

<form method="post" action="<?= $base ?>/payments/update" class="form">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">
  <input type="hidden" name="sale_id" value="<?= $item['sale_id'] ?>">

  <label>Fecha
    <input type="date" name="date" value="<?= htmlspecialchars($item['date']) ?>" required>
  </label>
  <label>Monto
    <input type="number" name="amount" step="0.01" min="0" value="<?= htmlspecialchars($item['amount']) ?>" required>
  </label>
  <label>Método
    <select name="method">
      <?php foreach (['cash','transfer','qr'] as $m): ?>
        <option value="<?= $m ?>" <?= $item['method']===$m ? 'selected':'' ?>><?= $m ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Referencia
    <input name="ref" value="<?= htmlspecialchars($item['ref']) ?>">
  </label>

  <button class="btn">Actualizar</button>
</form>

<p>
  <a class="btn" href="<?= $base ?>/payments?sale_id=<?= $item['sale_id'] ?>">Volver</a>
  <a class="btn" href="<?= $base ?>/sales/edit?id=<?= $item['sale_id'] ?>">Ir a la venta</a>
</p>
