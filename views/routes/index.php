<h2 class="routes-title">🗺️ Rutas</h2>
<div class="routes-actions">
  <a class="btn btn-primary" href="<?= $base ?>/routes/create">➕ Nueva ruta</a>
</div>
<div class="routes-table-wrap">
  <table class="routes-table">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['name'] ?? '') ?></td>
          <td><?= htmlspecialchars($row['description'] ?? '') ?></td>
          <td>
            <div class="actions-btn-group">
              <a class="btn btn-action" href="<?= $base ?>/routes/edit?id=<?= $row['id'] ?>">✏️ Editar</a>
              <form method="post" action="<?= $base ?>/routes/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar esta ruta?')">
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
.routes-title {
  margin-bottom: 18px;
  color: #1976d2;
  font-size: 1.7rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
}
.routes-actions {
  margin-bottom: 18px;
  display: flex;
  gap: 10px;
}
.routes-table-wrap {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 16px rgba(33,150,243,0.08);
  padding: 18px 8px 8px 8px;
  margin-bottom: 18px;
  overflow-x: auto;
}
.routes-table {
  width: 100%;
  min-width: 420px;
  border-collapse: collapse;
  border-radius: 10px;
  overflow: hidden;
  background: #fafdff;
  box-shadow: 0 1px 6px rgba(25,118,210,0.07);
}
.routes-table thead tr {
  background: linear-gradient(90deg, #e8f1fb 90%, #f4faff 100%);
  color: #1976d2;
  font-size: 1.07rem;
  letter-spacing: 0.5px;
}
.routes-table th, .routes-table td {
  padding: 13px 14px;
  text-align: left;
  border-bottom: 1px solid #eef1f5;
}
.routes-table th {
  font-weight: 700;
}
.routes-table td {
  font-size: 1.04rem;
  background: #fcfdff;
  vertical-align: middle;
}
.routes-table tbody tr:last-child td {
  border-bottom: none;
}
.routes-table tr:hover td {
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
  .routes-table, .routes-table thead, .routes-table tbody, .routes-table th, .routes-table td, .routes-table tr {
    display: block;
  }
  .routes-table thead tr {
    display: none;
  }
  .routes-table td {
    border-bottom: 1px solid #eef1f5;
  }
  .routes-table tr {
    margin-bottom: 16px;
  }
  .routes-table th, .routes-table td {
    padding: 10px 6px;
  }
  .btn, .btn-danger, .btn-primary {
    width: 100%;
    margin-bottom: 6px;
  }
  .routes-actions { flex-direction: column; align-items: stretch; }
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