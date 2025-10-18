<h2>Pagos<?= isset($sale_id) && $sale_id ? " de la venta #{$sale_id}" : "" ?></h2>

<p>
  <?php if (!empty($sale_id)): ?>
    <a class="btn" href="<?= $base ?>/payments/create?sale_id=<?= $sale_id ?>">Nuevo pago</a>
    <a class="btn" href="<?= $base ?>/sales/edit?id=<?= $sale_id ?>">Volver a la venta</a>
  <?php else: ?>
    <a class="btn" href="<?= $base ?>/payments/create">Nuevo pago</a>
  <?php endif; ?>
</p>

<table>
  <thead>
    <tr>
      <th>ID</th><th>Venta</th><th>Cliente</th><th>Fecha</th>
      <th>Monto</th><th>Método</th><th>Ref</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td>#<?= $row['sale_id'] ?></td>
      <td><?= htmlspecialchars($row['customer_name'] ?? '') ?></td>
      <td><?= htmlspecialchars($row['date']) ?></td>
      <td><?= htmlspecialchars($row['amount']) ?></td>
      <td><?= htmlspecialchars($row['method']) ?></td>
      <td><?= htmlspecialchars($row['ref']) ?></td>
      <td>
        <a class="btn" href="<?= $base ?>/payments/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/payments/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar pago?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
