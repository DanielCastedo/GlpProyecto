<h2 class="pagos-title">
  💳 Pagos<?= isset($sale_id) && $sale_id ? " de la venta #{$sale_id}" : "" ?>
</h2>

<div class="pagos-actions">
  <?php if (!empty($sale_id)): ?>
    <a class="btn btn-success" href="<?= $base ?>/payments/create?sale_id=<?= $sale_id ?>">➕ Nuevo pago</a>
    <a class="btn btn-back" href="<?= $base ?>/sales">← Volver a la venta</a>
  <?php else: ?>
    <a class="btn btn-success" href="<?= $base ?>/payments/create">➕ Nuevo pago</a>
  <?php endif; ?>
</div>

<div class="pagos-table-wrap">
  <table class="pagos-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Venta</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Monto</th>
        <th>Método</th>
        <th>Referencia</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $row): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td>#<?= $row['sale_id'] ?></td>
        <td><?= htmlspecialchars($row['customer_name'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['date']) ?></td>
        <td>$<?= number_format($row['amount'],2) ?></td>
        <td>
          <?php
            $icons = ['cash' => '💵', 'transfer' => '🏦', 'qr' => '📱'];
            echo $icons[$row['method']] ?? '';
          ?>
          <span><?= htmlspecialchars($row['method']) ?></span>
        </td>
        <td><?= htmlspecialchars($row['ref']) ?></td>
        <td>
          <div class="actions-btn-group">
            <a class="btn btn-action" href="<?= $base ?>/payments/edit?id=<?= $row['id'] ?>">✏️ Editar</a>
            <form method="post" action="<?= $base ?>/payments/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar pago?')">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button class="btn btn-danger btn-action" type="submit">🗑️ Eliminar</button>
            </form>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<style>
.pagos-title {
  margin-bottom: 18px;
  color: #1976d2;
  font-size: 2rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 12px;
}
.pagos-actions {
  margin-bottom: 18px;
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  align-items: center;
}
.pagos-table-wrap {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 14px rgba(33,150,243,0.09);
  padding: 20px 8px 8px 8px;
  margin-bottom: 18px;
  overflow-x: auto;
}
.pagos-table {
  width: 100%;
  min-width: 680px;
  border-collapse: collapse;
  background: #fafdff;
  border-radius: 10px;
  overflow: hidden;
}
.pagos-table thead tr {
  background: linear-gradient(90deg, #e8f1fb 90%, #f4faff 100%);
  color: #1976d2;
  font-size: 1.08rem;
  letter-spacing: 1px;
}
.pagos-table th, .pagos-table td {
  padding: 13px 14px;
  text-align: left;
  border-bottom: 1px solid #eef1f5;
}
.pagos-table th {
  font-weight: 700;
}
.pagos-table td {
  font-size: 1.05rem;
  background: #fcfdff;
  vertical-align: middle;
}
.pagos-table tbody tr:last-child td {
  border-bottom: none;
}
.pagos-table tr:hover td {
  background: #f0f7fc;
  transition: background 0.13s;
}
.actions-btn-group {
  display: flex;
  flex-direction: row;
  gap: 0;
  align-items: center;
}
.btn {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 8px 18px;
  border-radius: 7px;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
  margin-right: 4px;
  font-weight: 500;
  transition: background .18s, box-shadow .17s;
  display: inline-block;
}
.btn-success {
  background: #2ecc71;
  color: #fff;
  font-weight: 600;
}
.btn-success:hover, .btn-success:focus {
  background: #27ae60;
  color: #fff;
}
.btn-action {
  margin-right: 8px;
  margin-bottom: 0;
  background: #2196f3;
  color: #fff;
  font-weight: 500;
}
.btn-action:last-child {
  margin-right: 0 !important;
}
.btn-back {
  background: #fff;
  color: #1976d2;
  border: 2px solid #1976d2;
  font-weight: 600;
}
.btn-back:hover, .btn-back:focus {
  background: #1976d2;
  color: #fff;
}
.btn-danger {
  background: #e53935 !important;
}
.btn-danger:hover, .btn-danger:focus {
  background: #b71c1c !important;
}
@media (max-width: 800px) {
  .pagos-table, .pagos-table thead, .pagos-table tbody, .pagos-table th, .pagos-table td, .pagos-table tr { display: block; }
  .pagos-table thead tr { display: none; }
  .pagos-table td { border-bottom: 1px solid #eef1f5; }
  .pagos-table tr { margin-bottom: 14px; }
  .pagos-table th, .pagos-table td { padding: 10px 6px; }
  .btn, .btn-danger, .btn-back, .btn-success { width: 100%; margin-bottom: 6px; }
  .pagos-actions { flex-direction: column; align-items: stretch; }
  .actions-btn-group { flex-direction: column; gap: 6px; width: 100%; }
  .btn-action { margin: 0 0 6px 0 !important; width: 100%; }
}
</style>