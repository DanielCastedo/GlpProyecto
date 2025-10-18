<h2 style="margin-bottom:22px;">Ventas</h2>

<div class="table-search-wrap">
  <input type="search" class="table-search" id="salesSearch" placeholder="Buscar venta...">
  <a class="btn" href="<?= $base ?>/sales/create">Nueva venta</a>
  <a class="btn" href="<?= $base ?>/payments">Pagos</a>
</div>

<table id="salesTable" class="sales-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Fecha</th>
      <th>Cliente</th>
      <th>Teléfono</th>
      <th>Total</th>
      <th>Pagado</th>
      <th>Saldo</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $row): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['date']) ?></td>
        <td><?= htmlspecialchars($row['customer_name']) ?></td>
        <td><?= htmlspecialchars($row['customer_phone']) ?></td>
        <td><?= htmlspecialchars($row['total']) ?></td>
        <td><?= htmlspecialchars($row['amount_paid']) ?></td>
        <td><?= htmlspecialchars($row['balance_due']) ?></td>
        <td>
          <?php
          $estado = $row['status'];
          if ($estado == 'paid') {
            echo '<span class="status status-paid">Pagada</span>';
          } elseif ($estado == 'pending') {
            echo '<span class="status status-pending">Pendiente</span>';
          } elseif ($estado == 'cancelled') {
            echo '<span class="status status-cancelled">Cancelada</span>';
          }
          ?>
        </td>
        <td>
          <div class="actions-btn-group">

            <a class="btn btn-secondary btn-action" href="<?= $base ?>/sale_items?sale_id=<?= $row['id'] ?>">Items</a>
            <a class="btn btn-action" href="<?= $base ?>/sales/edit?id=<?= $row['id'] ?>">Editar</a>
            <form method="post" action="<?= $base ?>/sales/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar venta?')">
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
    max-width: 320px;
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

  .btn-secondary {
    background: #2196f3;
    color: #fff;
  }

  .btn-secondary:hover,
  .btn-secondary:focus {
    background: #176cb8;
  }

  .btn:hover,
  .btn:focus {
    background: #135ba1;
    box-shadow: 0 2px 12px rgba(25, 118, 210, 0.11);
  }

  .btn-danger {
    background: #e53935 !important;
  }

  .btn-danger:hover,
  .btn-danger:focus {
    background: #b71c1c !important;
  }

  .sales-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 2px 18px rgba(33, 150, 243, 0.09);
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 10px;
  }

  .sales-table thead tr {
    background: #1976d2;
    color: #fff;
    font-size: 1.07rem;
    letter-spacing: 1px;
  }

  .sales-table th,
  .sales-table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #eef1f5;
  }

  .sales-table tbody tr:last-child td {
    border-bottom: none;
  }

  .sales-table tr:hover td {
    background: #f5f8fd;
  }

  .sales-table th {
    font-weight: 600;
  }

  .sales-table td {
    font-size: 1rem;
  }

  .status {
    padding: 5px 13px;
    border-radius: 7px;
    font-weight: 600;
    font-size: 0.98rem;
    background: #eaf4fc;
    color: #1976d2;
    display: inline-block;
  }

  .status-paid {
    background: #e8f5e9;
    color: #43a047;
  }

  .status-pending {
    background: #fff3e0;
    color: #fb8c00;
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

    .sales-table,
    .sales-table thead,
    .sales-table tbody,
    .sales-table th,
    .sales-table td,
    .sales-table tr {
      display: block;
    }

    .sales-table thead tr {
      display: none;
    }

    .sales-table td {
      border-bottom: 1px solid #eef1f5;
    }

    .sales-table tr {
      margin-bottom: 14px;
    }

    .sales-table th,
    .sales-table td {
      padding: 10px 6px;
    }

    .btn,
    .btn-secondary,
    .btn-danger {
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
  // Buscador de tabla para ventas
  document.getElementById('salesSearch').addEventListener('input', function() {
    const value = this.value.toLowerCase();
    const rows = document.querySelectorAll('#salesTable tbody tr');
    rows.forEach(row => {
      let match = false;
      row.querySelectorAll('td').forEach(td => {
        if (td.textContent.toLowerCase().includes(value)) match = true;
      });
      row.style.display = match ? '' : 'none';
    });
  });
</script>