<h2>Products</h2>
<!-- Buscador -->
<div class="table-search-wrap">
  <input type="search" class="table-search" id="tableSearch" placeholder="Buscar...">
  <a class="btn" href="<?= $base ?>/products/create">Nuevo</a>
</div>

<!-- Tabla de productos -->
<table id="productsTable">
  <thead>
    <tr>
      <th>Name</th>
      <th>Sku</th>
      <th>Cylinder_weight_kg</th>
      <th>Price</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name'] ?? '') ?></td>
      <td><?= htmlspecialchars($row['sku'] ?? '') ?></td>
      <td><?= htmlspecialchars($row['cylinder_weight_kg'] ?? '') ?></td>
      <td><?= htmlspecialchars($row['price'] ?? '') ?></td>
      <td>
        <a class="btn" href="<?= $base ?>/products/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/products/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger" type="submit">Eliminar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Estilos CSS y JS -->
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
table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 2px 18px rgba(33,150,243,0.09);
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  margin-top: 10px;
}
thead tr {
  background: #1976d2;
  color: #fff;
  font-size: 1.07rem;
  letter-spacing: 1px;
}
th, td {
  padding: 12px 16px;
  text-align: left;
  border-bottom: 1px solid #eef1f5;
}
tbody tr:last-child td {
  border-bottom: none;
}
tr:hover td {
  background: #f5f8fd;
}
th {
  font-weight: 600;
}
td {
  font-size: 1rem;
}
@media (max-width: 700px) {
  table, thead, tbody, th, td, tr { display: block; }
  thead tr { display: none; }
  td { border-bottom: 1px solid #eef1f5; }
  tr { margin-bottom: 14px; }
  th, td { padding: 10px 6px; }
}
</style>
<script>
// Buscador de tabla
document.getElementById('tableSearch').addEventListener('input', function() {
  const value = this.value.toLowerCase();
  const rows = document.querySelectorAll('#productsTable tbody tr');
  rows.forEach(row => {
    let match = false;
    row.querySelectorAll('td').forEach(td => {
      if (td.textContent.toLowerCase().includes(value)) match = true;
    });
    row.style.display = match ? '' : 'none';
  });
});
</script>