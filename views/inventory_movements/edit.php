<a href="<?= $base ?>/inventory_movements" class="btn btn-back" style="margin-bottom:18px;">
  ← Volver
</a>

<h2 style="margin-bottom:24px;">Editar movimiento #<?= $item['id'] ?></h2>

<form method="post" action="<?= $base ?>/inventory_movements/update" class="inv-edit-form"
      oninput="if(type.value==='purchase' && qty.valueAsNumber<0){qty.value = Math.abs(qty.valueAsNumber)}
               if(type.value==='sale' && qty.valueAsNumber>0){qty.value = -Math.abs(qty.valueAsNumber)}">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">

  <div class="inv-edit-grid">
    <label>
      <span>Fecha</span>
      <input type="date" name="date" value="<?= htmlspecialchars($item['date']) ?>" required>
    </label>

    <label>
      <span>Producto</span>
      <select name="product_id" required>
        <?php foreach ($products as $p): ?>
          <option value="<?= $p['id'] ?>" <?= $p['id']==$item['product_id']?'selected':'' ?>>
            <?= htmlspecialchars($p['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <label>
      <span>Tipo</span>
      <select name="type" id="type" required>
        <?php foreach (['purchase','sale','adjustment'] as $t): ?>
          <option value="<?= $t ?>" <?= $item['type']===$t ? 'selected':'' ?>><?= $t ?></option>
        <?php endforeach; ?>
      </select>
    </label>

    <label>
      <span>Cantidad</span>
      <input type="number" name="qty" id="qty" step="1" value="<?= htmlspecialchars($item['qty']) ?>" required>
    </label>

    <label>
      <span>Ref. Tabla</span>
      <input name="ref_table" value="<?= htmlspecialchars($item['ref_table']) ?>">
    </label>
    <label>
      <span>Ref. ID</span>
      <input type="number" name="ref_id" min="0" value="<?= htmlspecialchars($item['ref_id']) ?>">
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
.inv-edit-form {
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
.inv-edit-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.inv-edit-form label {
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
.inv-edit-form input, .inv-edit-form select {
  margin-top: 2px;
  padding: 8px 12px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.03rem;
  background: #f9fcff;
  transition: border-color .18s;
}
.inv-edit-form input:focus, .inv-edit-form select:focus {
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
  .inv-edit-form {
    padding: 15px 2vw 14px 2vw;
    max-width: 97vw;
  }
  .inv-edit-grid {
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