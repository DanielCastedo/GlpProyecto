<h2 style="margin-bottom:22px;">Ítems de venta #<?= $sale_id ?></h2>

<div class="table-search-wrap">
  <input type="search" class="table-search" id="itemsSearch" placeholder="Buscar ítem...">
  <a class="btn btn-back" href="<?= $base ?>/sales">Volver a la venta</a>
    <a class="btn btn-success" href="<?= $base ?>/payments/create?sale_id=<?= $sale_id ?>">
    ➕ Nuevo pago
  </a>
  <a class="btn btn-secondary" href="<?= $base ?>/payments?sale_id=<?= $sale_id ?>">
    💳 Pagos
  </a>
  <a class="btn" href="<?= $base ?>/sale_items/create?sale_id=<?= $sale_id ?>">Agregar ítem</a>
  <a class="btn btn-secondary" href="<?= $base ?>/sale_items/add_multiple?sale_id=<?= $sale_id ?>">
    + Agregar ítems múltiples
  </a>
</div>



<table id="itemsTable" class="items-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Precio</th>
      <th>Subtotal</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $row): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['product_name']) ?></td>
        <td><?= htmlspecialchars($row['qty']) ?></td>
        <td><?= htmlspecialchars($row['unit_price']) ?></td>
        <td><?= htmlspecialchars($row['subtotal']) ?></td>
        <td>
          <div class="actions-btn-group">
            <a class="btn btn-action" href="<?= $base ?>/sale_items/edit?id=<?= $row['id'] ?>">Editar</a>
            <form method="post" action="<?= $base ?>/sale_items/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar ítem?')">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button class="btn btn-danger btn-action" type="submit">Eliminar</button>
            </form>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<style>
  .table-search-wrap {
    margin-bottom: 18px;
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

  .btn-action {
    margin-right: 8px;
    margin-bottom: 0;
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

  .btn-back:hover,
  .btn-back:focus {
    background: #1976d2;
    color: #fff;
  }

  .btn-danger {
    background: #e53935 !important;
  }

  .btn-danger:hover,
  .btn-danger:focus {
    background: #b71c1c !important;
  }

  .items-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 2px 18px rgba(33, 150, 243, 0.09);
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 10px;
  }

  .items-table thead tr {
    background: #1976d2;
    color: #fff;
    font-size: 1.07rem;
    letter-spacing: 1px;
  }

  .items-table th,
  .items-table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #eef1f5;
  }

  .items-table tbody tr:last-child td {
    border-bottom: none;
  }

  .items-table tr:hover td {
    background: #f5f8fd;
  }

  .items-table th {
    font-weight: 600;
  }

  .items-table td {
    font-size: 1rem;
  }

  .actions-btn-group {
    display: flex;
    flex-direction: row;
    gap: 0;
    align-items: center;
  }

  .actions-btn-group form {
    margin: 0;
  }

  @media (max-width: 700px) {

    .items-table,
    .items-table thead,
    .items-table tbody,
    .items-table th,
    .items-table td,
    .items-table tr {
      display: block;
    }

    .items-table thead tr {
      display: none;
    }

    .items-table td {
      border-bottom: 1px solid #eef1f5;
    }

    .items-table tr {
      margin-bottom: 14px;
    }

    .items-table th,
    .items-table td {
      padding: 10px 6px;
    }

    .btn,
    .btn-danger,
    .btn-back {
      width: 100%;
      margin-bottom: 6px;
    }

    .table-search-wrap {
      flex-direction: column;
      align-items: stretch;
    }

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
<script>
  // Buscador de tabla para ítems de venta
  document.getElementById('itemsSearch').addEventListener('input', function() {
    const value = this.value.toLowerCase();
    const rows = document.querySelectorAll('#itemsTable tbody tr');
    rows.forEach(row => {
      let match = false;
      row.querySelectorAll('td').forEach(td => {
        if (td.textContent.toLowerCase().includes(value)) match = true;
      });
      row.style.display = match ? '' : 'none';
    });
  });
</script>