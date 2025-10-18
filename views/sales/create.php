<a href="<?= $base ?>/sales" class="btn btn-back" style="margin-bottom:18px;">
  ← Volver
</a>

<h2 style="margin-bottom:24px;">Nueva venta</h2>

<form method="post" action="<?= $base ?>/sales/store" class="sale-new-form">
  <div class="sale-new-grid">
    <label>
      <span>Fecha</span>
      <input type="date" name="date" value="<?= date('Y-m-d') ?>" required>
    </label>
    <label>
      <span>Cliente</span>
      <input name="customer_name" required placeholder="Ej: Juan Pérez">
    </label>
    <label>
      <span>Teléfono</span>
      <input name="customer_phone" required placeholder="Ej: 78912345">
    </label>
    <label>
      <span>Chofer</span>
      <select name="driver_id" required>
        <option value="">-- Seleccionar chofer --</option>
        <?php foreach ($drivers as $d): ?>
          <option value="<?= $d['id'] ?>">
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
          <option value="<?= $r['id'] ?>">
            <?= htmlspecialchars($r['name'] ?? ('Ruta ' . $r['id'])) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>
      <span>Estado</span>
      <select name="status" required>
        <option value="pending">Pendiente</option>
        <option value="paid">Pagado</option>
        <option value="cancelled">Cancelado</option>
      </select>
    </label>
  </div>
  <button class="btn btn-primary" type="submit">Guardar</button>
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
.sale-new-form {
  background: #f5f8fd;
  border-radius: 15px;
  box-shadow: 0 1px 12px rgba(33,150,243,0.08);
  padding: 28px 26px 18px 26px;
  max-width: 600px;
  margin: 0 auto 32px auto;
  display: flex;
  flex-direction: column;
  gap: 22px;
}
.sale-new-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.sale-new-form label {
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
.sale-new-form input, .sale-new-form select {
  margin-top: 2px;
  padding: 8px 12px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.03rem;
  background: #f9fcff;
  transition: border-color .18s;
}
.sale-new-form input:focus, .sale-new-form select:focus {
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
  .sale-new-form {
    padding: 15px 2vw 14px 2vw;
    max-width: 97vw;
  }
  .sale-new-grid {
    grid-template-columns: 1fr;
    gap: 14px;
  }
  .btn, .btn-primary, .btn-back {
    width: 100%;
    padding: 11px 0;
    margin-top: 18px;
    align-self: stretch;
    font-size: 1.07rem;
  }
}
</style>