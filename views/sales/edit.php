<h2>Editar venta #<?= $item['id'] ?></h2>

<p>
  <a class="btn" href="<?= $base ?>/sale_items?sale_id=<?= $item['id'] ?>">Gestionar ítems</a>
  <a class="btn" href="<?= $base ?>/payments?sale_id=<?= $item['id'] ?>">Pagos</a>
</p>

<form method="post" action="<?= $base ?>/sales/update" class="form">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">
  <label>Fecha <input type="date" name="date" value="<?= htmlspecialchars($item['date']) ?>" required></label>
  <label>Cliente <input name="customer_name" value="<?= htmlspecialchars($item['customer_name']) ?>"></label>
  <label>Teléfono <input name="customer_phone" value="<?= htmlspecialchars($item['customer_phone']) ?>"></label>
  <label>ID Chofer <input name="driver_id" type="number" value="<?= htmlspecialchars($item['driver_id']) ?>"></label>
  <label>ID Ruta <input name="route_id" type="number" value="<?= htmlspecialchars($item['route_id']) ?>"></label>
  <label>Total <input name="total" type="number" step="0.01" value="<?= htmlspecialchars($item['total']) ?>" readonly></label>
  <label>Pagado <input name="amount_paid" type="number" step="0.01" value="<?= htmlspecialchars($item['amount_paid']) ?>"></label>
  <label>Saldo <input name="balance_due" type="number" step="0.01" value="<?= htmlspecialchars($item['balance_due']) ?>" readonly></label>
  <label>Estado
    <select name="status">
      <?php $sts=['pending','paid','cancelled']; foreach ($sts as $s): ?>
        <option value="<?= $s ?>" <?= $item['status']===$s?'selected':'' ?>><?= $s ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <button class="btn">Actualizar</button>
</form>
