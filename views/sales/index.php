<h2>Ventas</h2>
<p><a class="btn" href="<?= $base ?>/sales/create">Nueva venta</a></p>

<table>
  <thead>
    <tr>
      <th>ID</th><th>Fecha</th><th>Cliente</th><th>Teléfono</th>
      <th>Total</th><th>Pagado</th><th>Saldo</th><th>Estado</th><th>Acciones</th>
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
      <td><?= htmlspecialchars($row['status']) ?></td>
      <td>
        <a class="btn" href="<?= $base ?>/sales/edit?id=<?= $row['id'] ?>">Editar</a>
        <a class="btn" href="<?= $base ?>/sale_items?sale_id=<?= $row['id'] ?>">Items</a>
        <form method="post" action="<?= $base ?>/sales/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar venta?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
