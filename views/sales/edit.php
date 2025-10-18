<a href="<?= $base ?>/sales" class="btn btn-back" style="margin-bottom:18px;">
  ← Volver
</a>

<h2 style="margin-bottom:24px;">Editar venta #<?= $item['id'] ?></h2>

<p style="margin-bottom:18px;">
  <a class="btn btn-secondary" href="<?= $base ?>/sale_items?sale_id=<?= $item['id'] ?>">Gestionar ítems</a>

</p>

<form method="post" action="<?= $base ?>/sales/update" class="sale-edit-form">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">

  <div class="sale-edit-grid">
    <label>
      <span>Fecha</span>
      <input type="date" name="date" value="<?= htmlspecialchars($item['date']) ?>" required>
    </label>
    <label>
      <span>Cliente</span>
      <input name="customer_name" value="<?= htmlspecialchars($item['customer_name']) ?>">
    </label>
    <label>
      <span>Teléfono</span>
      <input name="customer_phone" value="<?= htmlspecialchars($item['customer_phone']) ?>">
    </label>
    <label>
      <span>Chofer</span>
      <select name="driver_id" required>
        <option value="">-- Seleccionar chofer --</option>
        <?php foreach ($drivers as $d): ?>
          <option value="<?= $d['id'] ?>" <?= $item['driver_id']==$d['id']?'selected':'' ?>>
            <?= htmlspecialchars($d['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>
      <span>Ruta</span>
      <select name="route_id" required>
        <option value="">-- Seleccionar ruta --</option>
        <?php foreach ($routes as $r): ?>
          <option value="<?= $r['id'] ?>" <?= $item['route_id']==$r['id']?'selected':'' ?>>
            <?= htmlspecialchars($r['name'] ?? ('Ruta ' . $r['id'])) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>
      <span>Total</span>
      <input name="total" type="number" step="0.01" value="<?= htmlspecialchars($item['total']) ?>" readonly>
    </label>
    <label>
      <span>Pagado</span>
      <input name="amount_paid" type="number" step="0.01" value="<?= htmlspecialchars($item['amount_paid']) ?>">
    </label>
    <label>
      <span>Saldo</span>
      <input name="balance_due" type="number" step="0.01" value="<?= htmlspecialchars($item['balance_due']) ?>" readonly>
    </label>
    <label>
      <span>Estado</span>
      <select name="status">
        <?php $sts=['pending','paid','cancelled']; foreach ($sts as $s): ?>
          <option value="<?= $s ?>" <?= $item['status']===$s?'selected':'' ?>><?= ucfirst($s) ?></option>
        <?php endforeach; ?>
      </select>
    </label>
  </div>

  <button class="btn btn-primary" type="submit">Actualizar</button>
</form>

<style>
.btn-back {
  background: #fff;
  color: #1976d2;
  border: 2px solid #1976d2;
  padding: 8px 22px;
  border-radius: 8px;
  font-size: 1.02rem;
  font-weight: 600;
  box-shadow: 0 1px 8px rgba(25,118,210,0.05);
  display: inline-block;
  transition: background .18s, color .18s, border .18s;
  margin-bottom: 8px;
}
.btn-back:hover, .btn-back:focus {
  background: #1976d2;
  color: #fff;
}
.btn-secondary {
  background: #2196f3;
  color: #fff;
}
.btn-secondary:hover, .btn-secondary:focus {
  background: #176cb8;
}
.sale-edit-form {
  background: #f5f8fd;
  border-radius: 15px;
  box-shadow: 0 1px 12px rgba(33,150,243,0.08);
  padding: 28px 26px 18px 26px;
  max-width: 650px;
  margin: 0 auto 32px auto;
  display: flex;
  flex-direction: column;
  gap: 22px;
}
.sale-edit-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.sale-edit-form label {
  display: flex;
  flex-direction: column;
  background: #fff;
  border-radius: 8px;
  padding: 16px 14px;
  box-shadow: 0 1px 8px rgba(25,118,210,0.06);
  font-size: 1rem;
  color: #1976d2;
  font-weight: 600;
  gap: 6px;
}
.sale-edit-form input, .sale-edit-form select {
  margin-top: 2px;
  padding: 8px 12px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.03rem;
  background: #f9fcff;
  transition: border-color .18s;
}
.sale-edit-form input:focus, .sale-edit-form select:focus {
  border-color: #1976d2;
  outline: none;
}
.btn, .btn-primary {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 11px 32px;
  border-radius: 8px;
  font-size: 1.09rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 600;
  box-shadow: 0 1px 8px rgba(25,118,210,0.11);
  transition: background .18s, box-shadow .17s;
  margin-top: 18px;
  align-self: center;
}
.btn-primary:hover, .btn-primary:focus, .btn:hover, .btn:focus {
  background: #135ba1;
}

/* Responsive: móvil/tablet */
@media (max-width: 900px) {
  .sale-edit-form {
    padding: 15px 2vw 14px 2vw;
    max-width: 97vw;
  }
  .sale-edit-grid {
    grid-template-columns: 1fr;
    gap: 14px;
  }
  .btn, .btn-primary, .btn-back, .btn-secondary {
    width: 100%;
    padding: 11px 0;
    margin-top: 18px;
    align-self: stretch;
    font-size: 1.07rem;
  }
}
</style>