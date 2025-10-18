<h2>Nuevo pago<?= !empty($sale_id) ? " para la venta #{$sale_id}" : "" ?></h2>

<form method="post" action="<?= $base ?>/payments/store" class="form">
  <label>ID Venta
    <input type="number" name="sale_id" value="<?= htmlspecialchars($sale_id ?? '') ?>" min="1" required>
  </label>
  <label>Fecha
    <input type="date" name="date" value="<?= date('Y-m-d') ?>" required>
  </label>
  <label>Monto
    <input type="number" name="amount" step="0.01" min="0" required>
  </label>
  <label>Método
    <select name="method">
      <option value="cash">cash</option>
      <option value="transfer">transfer</option>
      <option value="qr">qr</option>
    </select>
  </label>
  <label>Referencia
    <input name="ref" placeholder="N° operación / nota">
  </label>
  <button class="btn">Guardar</button>
</form>

<?php if (!empty($sale_id)): ?>
  <p><a class="btn" href="<?= $base ?>/payments?sale_id=<?= $sale_id ?>">Volver</a></p>
<?php endif; ?>
