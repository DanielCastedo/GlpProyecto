<h2>Nuevo pago<?= !empty($sale_id) ? " para la venta #{$sale_id}" : "" ?></h2>

<?php if (!empty($venta)): ?>
  <div class="venta-info-pago">
    <strong>Monto total de la venta:</strong>
    <span class="venta-monto">$<?= number_format($venta['total'], 2) ?></span>
    <?php if (isset($venta['amount_paid'])): ?>
      &nbsp; | <strong>Pagado:</strong> <span>$<?= number_format($venta['amount_paid'], 2) ?></span>
      &nbsp; | <strong>Saldo:</strong> <span>$<?= number_format($venta['balance_due'], 2) ?></span>
    <?php endif; ?>
  </div>
<?php endif; ?>

<form method="post" action="<?= $base ?>/payments/store" class="form">
  <label>ID Venta
    <input type="number" name="sale_id" value="<?= htmlspecialchars($sale_id ?? '') ?>" min="1" required>
  </label>
  <label>Fecha
    <input type="date" name="date" value="<?= date('Y-m-d') ?>" required>
  </label>
  <label>Monto
    <input
      type="number"
      name="amount"
      step="0.01"
      min="0"
      value="" require>
  </label>
  <label>Método
    <select name="method">
      <option value="cash">Efectivo</option>
      <option value="transfer">Transferencia</option>
      <option value="qr">QR</option>
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

<style>
  .venta-info-pago {
    background: #edf6fd;
    color: #1565c0;
    border-radius: 8px;
    padding: 12px 18px;
    margin-bottom: 18px;
    font-size: 1.12rem;
    font-weight: 600;
    box-shadow: 0 1px 7px rgba(33, 150, 243, 0.04);
  }

  .venta-monto {
    color: #1976d2;
    font-weight: bold;
    font-size: 1.13rem;
  }

  .form label {
    display: flex;
    flex-direction: column;
    font-weight: 600;
    color: #1976d2;
    margin-bottom: 13px;
  }

  .form input,
  .form select {
    padding: 8px 12px;
    border-radius: 7px;
    border: 1px solid #d0d7de;
    font-size: 1.06rem;
    background: #f9fcff;
  }

  .form button.btn {
    background: #1976d2;
    color: #fff;
    border: none;
    border-radius: 7px;
    font-size: 1.07rem;
    padding: 11px 28px;
    margin-top: 14px;
    cursor: pointer;
    font-weight: 600;
  }

  .form button.btn:hover {
    background: #135ba1;
  }
</style>