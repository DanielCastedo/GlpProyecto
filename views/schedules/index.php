<h2 style="margin-bottom:22px; font-size:1.25rem;">Horarios</h2>

<a class="btn btn-primary" style="margin-bottom:18px;" href="<?= $base ?>/schedules/create">+ Nuevo Horario</a>

<div class="table-responsive">
  <table class="schedules-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ruta</th>
        <th>Día</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
      <tr>
        <td><?= $item['id'] ?></td>
        <td><?= htmlspecialchars($item['route_name']) ?></td>
        <td><?= ["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"][$item['day_of_week']] ?></td>
        <td><?= htmlspecialchars($item['start_time']) ?></td>
        <td><?= htmlspecialchars($item['end_time']) ?></td>
        <td>
          <div class="actions-btn-group">
            <a class="btn btn-edit" href="<?= $base ?>/schedules/edit?id=<?= $item['id'] ?>">Editar</a>
            <form method="post" action="<?= $base ?>/schedules/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar horario?')">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">
              <button class="btn btn-danger" type="submit">Eliminar</button>
            </form>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<style>
.table-responsive {
  width: 100%;
  overflow-x: auto;
  margin-bottom: 18px;
}

.schedules-table {
  width: 100%;
  min-width: 680px;
  border-collapse: collapse;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 14px rgba(33,150,243,0.07);
  overflow: hidden;
}

.schedules-table thead tr {
  background: #1976d2;
  color: #fff;
  font-size: 1.05rem;
}

.schedules-table th, .schedules-table td {
  padding: 12px 18px;
  text-align: left;
  border-bottom: 1px solid #e3e8f0;
  font-size: 1rem;
  word-break: break-word;
}

.schedules-table tbody tr:last-child td {
  border-bottom: none;
}

.schedules-table tr:hover td {
  background: #f5f8fd;
}

.schedules-table th {
  font-weight: 600;
}

.actions-btn-group {
  display: flex;
  gap: 8px;
}

.btn {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 7px 17px;
  border-radius: 7px;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 500;
  transition: background .18s, box-shadow .17s;
  display: inline-block;
}
.btn-primary {
  background: #2563eb;
}
.btn-edit {
  background: #8ecae6;
  color: #1976d2;
}
.btn-edit:hover {
  background: #2196f3;
  color: #fff;
}
.btn-danger {
  background: #e53935 !important;
  color: #fff !important;
}
.btn-danger:hover {
  background: #b71c1c !important;
}
.btn:hover, .btn:focus {
  background: #135ba1;
  box-shadow: 0 2px 10px rgba(25,118,210,0.09);
}
.table-responsive {
  width: 100%;
  overflow-x: auto;
}
@media (max-width: 800px) {
  .schedules-table {
    min-width: 520px;
  }
  .schedules-table th, .schedules-table td {
    padding: 10px 7px;
    font-size: 0.98rem;
  }
  .actions-btn-group {
    flex-direction: column;
    gap: 6px;
  }
  .btn, .btn-edit, .btn-danger {
    width: 100%;
    margin-bottom: 5px;
  }
}
</style>