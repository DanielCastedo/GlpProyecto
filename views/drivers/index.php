<h2 style="margin-bottom:22px;">Drivers</h2>
<div class="table-search-wrap">
  <input type="search" class="table-search" id="driversSearch" placeholder="Buscar chofer...">
  <a class="btn" href="<?= $base ?>/drivers/create">Nuevo</a>
</div>

<table id="driversTable" class="drivers-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Phone</th>
      <th>License</th>
      <th>Truck ID</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name'] ?? '') ?></td>
      <td><?= htmlspecialchars($row['phone'] ?? '') ?></td>
      <td><?= htmlspecialchars($row['license'] ?? '') ?></td>
      <td><?= htmlspecialchars($row['truck_id'] ?? '') ?></td>
      <td>
        <a class="btn" href="<?= $base ?>/drivers/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/drivers/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger" type="submit">Eliminar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<style>
.table-search-wrap {
  margin-bottom: 16px;
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  align-items: center;
}
.table-search {
  padding: 8px 14px;
  border-radius: 6px;
  border: 1px solid #d0d7de;
  font-size: 1rem;
  width: 100%;
  max-width: 300px;
  transition: border-color 0.17s;
}
.table-search:focus {
  border-color: #1976d2;
  outline: none;
}
.btn {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 7px 18px;
  border-radius: 6px;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
  margin-right: 4px;
  transition: background .18s, box-shadow .17s;
  font-weight: 500;
  display: inline-block;
}
.btn:hover, .btn:focus {
  background: #135ba1;
  box-shadow: 0 2px 12px rgba(25,118,210,0.11);
}
.btn-danger {
  background: #e53935 !important;
}
.btn-danger:hover, .btn-danger:focus {
  background: #b71c1c !important;
}
.drivers-table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 2px 18px rgba(33,150,243,0.09);
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  margin-top: 10px;
}
.drivers-table thead tr {
  background: #1976d2;
  color: #fff;
  font-size: 1.07rem;
  letter-spacing: 1px;
}
.drivers-table th, .drivers-table td {
  padding: 12px 16px;
  text-align: left;
  border-bottom: 1px solid #eef1f5;
}
.drivers-table tbody tr:last-child td {
  border-bottom: none;
}
.drivers-table tr:hover td {
  background: #f5f8fd;
}
.drivers-table th {
  font-weight: 600;
}
.drivers-table td {
  font-size: 1rem;
}
@media (max-width: 700px) {
  .drivers-table, .drivers-table thead, .drivers-table tbody, .drivers-table th, .drivers-table td, .drivers-table tr { display: block; }
  .drivers-table thead tr { display: none; }
  .drivers-table td { border-bottom: 1px solid #eef1f5; }
  .drivers-table tr { margin-bottom: 14px; }
  .drivers-table th, .drivers-table td { padding: 10px 6px; }
  .btn, .btn-danger { width: 100%; margin-bottom: 6px; }
  .table-search-wrap { flex-direction: column; align-items: stretch; }
}
</style>
<script>
// Buscador de tabla para drivers
document.getElementById('driversSearch').addEventListener('input', function() {
  const value = this.value.toLowerCase();
  const rows = document.querySelectorAll('#driversTable tbody tr');
  rows.forEach(row => {
    let match = false;
    row.querySelectorAll('td').forEach(td => {
      if (td.textContent.toLowerCase().includes(value)) match = true;
    });
    row.style.display = match ? '' : 'none';
  });
});
</script>