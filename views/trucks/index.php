<h2 class="trucks-title">🚚 Camiones</h2>
<div class="trucks-actions">
  <a class="btn btn-primary" href="<?= $base ?>/trucks/create">➕ Nuevo camión</a>
</div>
<div class="trucks-table-wrap">
  <table class="trucks-table">
    <thead>
      <tr>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Capacidad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['plate'] ?? '') ?></td>
          <td><?= htmlspecialchars($row['model'] ?? '') ?></td>
          <td><?= htmlspecialchars($row['capacity_units'] ?? '') ?></td>
          <td>
            <div class="actions-btn-group">
              <a class="btn btn-action" href="<?= $base ?>/trucks/edit?id=<?= $row['id'] ?>">✏️ Editar</a>
              <form method="post" action="<?= $base ?>/trucks/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar este camión?')">
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
.trucks-title {
  margin-bottom: 18px;
  color: #1976d2;
  font-size: 1.7rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
}
.trucks-actions {
  margin-bottom: 18px;
  display: flex;
  gap: 10px;
}
.trucks-table-wrap {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 16px rgba(33,150,243,0.08);
  padding: 18px 8px 8px 8px;
  margin-bottom: 18px;
  overflow-x: auto;
}
.trucks-table {
  width: 100%;
  min-width: 600px;
  border-collapse: collapse;
  border-radius: 10px;
  overflow: hidden;
  background: #fafdff;
  box-shadow: 0 1px 6px rgba(25,118,210,0.07);
}
.trucks-table thead tr {
  background: linear-gradient(90deg, #e8f1fb 90%, #f4faff 100%);
  color: #1976d2;
  font-size: 1.07rem;
  letter-spacing: 0.5px;
}
.trucks-table th, .trucks-table td {
  padding: 13px 14px;
  text-align: left;
  border-bottom: 1px solid #eef1f5;
}
.trucks-table th {
  font-weight: 700;
}
.trucks-table td {
  font-size: 1.04rem;
  background: #fcfdff;
  vertical-align: middle;
}
.trucks-table tbody tr:last-child td {
  border-bottom: none;
}
.trucks-table tr:hover td {
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
  padding: 8px 17px;
  border-radius: 7px;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
  margin-right: 4px;
  font-weight: 500;
  transition: background .18s, box-shadow .17s;
  display: inline-block;
}
.btn-primary {
  background: #2196f3;
  color: #fff;
  font-weight: 600;
}
.btn-action {
  margin-right: 8px;
  margin-bottom: 0;
  background: #8ecae6;
  color: #1976d2;
  font-weight: 600;
}
.btn-action:last-child {
  margin-right: 0 !important;
}
.btn-danger {
  background: #e53935 !important;
}
.btn-danger:hover, .btn-danger:focus {
  background: #b71c1c !important;
}
@media (max-width: 700px) {
  .trucks-table, .trucks-table thead, .trucks-table tbody, .trucks-table th, .trucks-table td, .trucks-table tr {
    display: block;
  }
  .trucks-table thead tr {
    display: none;
  }
  .trucks-table td {
    border-bottom: 1px solid #eef1f5;
  }
  .trucks-table tr {
    margin-bottom: 16px;
  }
  .trucks-table th, .trucks-table td {
    padding: 10px 6px;
  }
  .btn, .btn-danger, .btn-primary {
    width: 100%;
    margin-bottom: 6px;
  }
  .trucks-actions { flex-direction: column; align-items: stretch; }
  .actions-btn-group {
    flex-direction: column;
    gap: 6px;
    width: 100%;
  }
  .btn-action {
    margin: 0 0 6px 0 !important;
    width: 100%;
  }
}
</style>