<h2>Nueva venta</h2>
<form method="post" action="<?= $base ?>/sales/store" class="form">
  <label>Fecha <input type="date" name="date" value="<?= date('Y-m-d') ?>" required></label>
  <label>Cliente <input name="customer_name"></label>
  <label>Teléfono <input name="customer_phone"></label>
  <label>ID Chofer <input name="driver_id" type="number" min="0"></label>
  <label>ID Ruta <input name="route_id" type="number" min="0"></label>
  <label>Pagado (monto) <input name="amount_paid" type="number" step="0.01" value="0"></label>
  <label>Estado
    <select name="status">
      <option value="pending">pending</option>
      <option value="paid">paid</option>
      <option value="cancelled">cancelled</option>
    </select>
  </label>
  <button class="btn">Guardar</button>
</form>
