<h2>Compras</h2>
<a class="btn" href="<?= $base ?>/purchases/create">Nueva Compra</a>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Fecha</th>
      <th>Proveedor</th>
      <th>Chofer</th>
      <th>Camión</th>
      <th>Total</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['date'] ?></td>
      <td><?= htmlspecialchars($row['supplier']) ?></td>
      <td><?= htmlspecialchars($row['driver_name']) ?></td>
      <td><?= htmlspecialchars($row['truck_plate']) ?></td>
      <td><?= number_format($row['total'],2) ?></td>
      <td><?= htmlspecialchars($row['status']) ?></td>
      <td>
        <a class="btn" href="<?= $base ?>/purchases/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/purchases/destroy" style="display:inline">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger" onclick="return confirm('¿Eliminar compra?')">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
