<h2 class="pagos-title">
  ✏️ Editar pago #<?= $item['id'] ?> <span class="venta-ref">(venta #<?= $item['sale_id'] ?>)</span>
</h2>

<form method="post" action="<?= $base ?>/payments/update" class="form pagos-form">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">
  <input type="hidden" name="sale_id" value="<?= $item['sale_id'] ?>">

  <table class="pagos-form-table">
    <tr>
      <th>Fecha</th>
      <td>
        <input type="date" name="date" value="<?= htmlspecialchars($item['date']) ?>" required>
      </td>
    </tr>
    <tr>
      <th>Monto</th>
      <td>
        <input type="number" name="amount" step="0.01" min="0" value="<?= htmlspecialchars($item['amount']) ?>" required>
      </td>
    </tr>
    <tr>
      <th>Método</th>
      <td>
        <select name="method">
          <?php foreach (['cash','transfer','qr'] as $m): ?>
            <option value="<?= $m ?>" <?= $item['method']===$m ? 'selected':'' ?>>
              <?= ucfirst($m) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <th>Referencia</th>
      <td>
        <input name="ref" value="<?= htmlspecialchars($item['ref']) ?>" placeholder="N° operación / nota">
      </td>
    </tr>
  </table>

  <button class="btn btn-primary">Actualizar</button>
</form>

<div class="pagos-actions">
  <a class="btn btn-back" href="<?= $base ?>/payments?sale_id=<?= $item['sale_id'] ?>">← Volver</a>
  <a class="btn btn-secondary" href="<?= $base ?>/sales/edit?id=<?= $item['sale_id'] ?>">Ir a la venta</a>
</div>

<style>
.pagos-title {
  margin-bottom: 18px;
  color: #1976d2;
  font-size: 1.7rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
}
.venta-ref { font-weight: 500; color: #1565c0; font-size: 1.1rem; margin-left: 8px; }

.pagos-form {
  background: #f7fafd;
  border-radius: 13px;
  box-shadow: 0 1px 12px rgba(33,150,243,0.07);
  padding: 30px 24px 20px 24px;
  max-width: 430px;
  margin: 0 auto 34px auto;
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.pagos-form-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 1px 6px rgba(25,118,210,0.07);
  margin-bottom: 12px;
  overflow: hidden;
}
.pagos-form-table th, .pagos-form-table td {
  font-size: 1.07rem;
  text-align: left;
  padding: 13px 10px 13px 16px;
  border-bottom: 1px solid #eef1f5;
}
.pagos-form-table th {
  background: #f6faff;
  color: #1976d2;
  font-weight: 700;
  min-width: 130px;
  width: 35%;
  border-right: 1px solid #e0eaf7;
}
.pagos-form-table tr:last-child th, .pagos-form-table tr:last-child td {
  border-bottom: none;
}
.pagos-form-table td {
  background: #fcfdff;
}
.pagos-form input,
.pagos-form select {
  padding: 9px 13px;
  border-radius: 8px;
  border: 1px solid #d0d7de;
  font-size: 1.09rem;
  background: #f9fcff;
  transition: border-color .16s;
  width: 100%;
  box-sizing: border-box;
}
.pagos-form input:focus,
.pagos-form select:focus {
  border-color: #1976d2;
  outline: none;
}
.btn, .btn-primary {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 12px 36px;
  border-radius: 9px;
  font-size: 1.11rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 600;
  box-shadow: 0 1px 8px rgba(25,118,210,0.09);
  transition: background .17s, box-shadow .14s;
  margin-top: 18px;
  align-self: center;
}
.btn-primary:hover, .btn-primary:focus, .btn:hover, .btn:focus {
  background: #135ba1;
}
.pagos-actions {
  margin-top: 12px;
  display: flex;
  gap: 10px;
  justify-content: center;
  flex-wrap: wrap;
}
.btn-back {
  background: #fff;
  color: #1976d2;
  border: 2px solid #1976d2;
  font-weight: 600;
  border-radius: 8px;
  padding: 10px 22px;
  font-size: 1.03rem;
  transition: background .18s, color .18s, border .18s;
  display: inline-block;
}
.btn-back:hover, .btn-back:focus {
  background: #dbeafe;
  color: #1976d2;
}
.btn-secondary {
  background: #8ecae6;
  color: #1976d2;
  border: none;
  font-weight: 600;
  border-radius: 8px;
  padding: 10px 22px;
  font-size: 1.03rem;
  transition: background .16s, color .16s;
}
.btn-secondary:hover, .btn-secondary:focus {
  background: #90e0ef;
  color: #135ba1;
}

/* Responsive */
@media (max-width: 700px) {
  .pagos-form {
    padding: 12px 2vw 10px 2vw;
    max-width: 99vw;
  }
  .pagos-form-table th, .pagos-form-table td {
    padding: 10px 6px;
    font-size: 1.01rem;
  }
  .btn, .btn-primary, .btn-back, .btn-secondary {
    width: 100%;
    padding: 12px 0;
    margin-top: 16px;
    align-self: stretch;
    font-size: 1.07rem;
  }
  .pagos-actions { flex-direction: column; gap: 6px; }
}
</style>