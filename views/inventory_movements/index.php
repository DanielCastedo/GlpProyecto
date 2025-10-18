<h2 style="margin-bottom: 18px;">Movimientos de Inventario</h2>

<form method="get" action="<?= $base ?>/inventory_movements" class="inv-mov-form">
  <label>
    <span>Producto</span>
    <select name="product_id">
      <option value="">-- Todos --</option>
      <?php foreach ($products as $p): ?>
        <option value="<?= $p['id'] ?>" <?= (isset($product_id) && (int)$product_id === (int)$p['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($p['name']) ?>
          <?php if (!empty($stockByProduct[(int)$p['id']])): ?>
            (Stock: <?= (int)$stockByProduct[(int)$p['id']] ?>)
          <?php endif; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
  <button class="btn" type="submit">Filtrar</button>
  <a class="btn btn-primary" href="<?= $base ?>/inventory_movements/create">Nuevo movimiento</a>
</form>

<table class="inv-mov-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Fecha</th>
      <th>Producto</th>
      <th>Tipo</th>
      <th>Cantidad</th>
      <th>Ref Table</th>
      <th>Ref ID</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $row): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['date']) ?></td>
      <td><?= htmlspecialchars($row['product_name']) ?></td>
      <td><?= htmlspecialchars($row['type']) ?></td>
      <td><?= htmlspecialchars($row['qty']) ?></td>
      <td><?= htmlspecialchars($row['ref_table']) ?></td>
      <td><?= htmlspecialchars($row['ref_id']) ?></td>
      <td>
        <a class="btn btn-sm" href="<?= $base ?>/inventory_movements/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/inventory_movements/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar movimiento?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<style>
/* Formulario de filtros */
.inv-mov-form {
  margin-bottom: 18px;
  display: flex;
  gap: 12px;
  align-items: center;
  flex-wrap: wrap;
  background: #f5f8fd;
  padding: 12px 18px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(33,150,243,.07);
}
.inv-mov-form label {
  display: flex;
  flex-direction: column;
  font-size: 1rem;
  color: #1976d2;
  font-weight: 600;
}
.inv-mov-form select {
  margin-top: 4px;
  padding: 6px 12px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1rem;
  min-width: 160px;
  background: #fff;
  transition: border-color .18s;
}
.inv-mov-form select:focus {
  border-color: #1976d2;
  outline: none;
}

/* Botones */
.btn {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 7px 16px;
  border-radius: 7px;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 500;
  transition: background .18s, box-shadow .17s;
  box-shadow: 0 1px 8px rgba(25,118,210,0.08);
  display: inline-block;
}
.btn-primary {
  background: #2196f3;
}
.btn-sm {
  padding: 5px 11px;
  font-size: .98rem;
}
.btn-danger {
  background: #e53935 !important;
}
.btn-danger:hover, .btn-danger:focus {
  background: #b71c1c !important;
}
.btn:hover, .btn:focus, .btn-primary:hover, .btn-primary:focus {
  background: #135ba1;
}
@media (max-width: 700px) {
  .btn, .btn-primary, .btn-sm { width: 100%; margin-top: 6px; }
}

/* Tabla profesional */
.inv-mov-table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 2px 18px rgba(33,150,243,0.09);
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  margin-top: 10px;
}
.inv-mov-table thead tr {
  background: #1976d2;
  color: #fff;
  font-size: 1.07rem;
}
.inv-mov-table th, .inv-mov-table td {
  padding: 12px 14px;
  text-align: left;
  border-bottom: 1px solid #eef1f5;
}
.inv-mov-table tbody tr:last-child td {
  border-bottom: none;
}
.inv-mov-table tr:hover td {
  background: #f5f8fd;
}
.inv-mov-table th {
  font-weight: 600;
}
.inv-mov-table td {
  font-size: 1rem;
}
@media (max-width: 800px) {
  .inv-mov-table, .inv-mov-table thead, .inv-mov-table tbody, .inv-mov-table th, .inv-mov-table td, .inv-mov-table tr {
    display: block;
  }
  .inv-mov-table thead tr { display: none; }
  .inv-mov-table td { border-bottom: 1px solid #eef1f5; }
  .inv-mov-table tr { margin-bottom: 13px; }
  .inv-mov-table th, .inv-mov-table td { padding: 8px 6px; }
}
</style>