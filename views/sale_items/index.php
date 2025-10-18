<h2>Ítems de venta #<?= $sale_id ?></h2>

<p>
  <a class="btn" href="<?= $base ?>/sale_items/create?sale_id=<?= $sale_id ?>">Agregar ítem</a>
  <a class="btn" href="<?= $base ?>/sales/edit?id=<?= $sale_id ?>">Volver a la venta</a>
</p>

<table>
  <thead>
    <tr>
      <th>ID</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th>Acciones</th>
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
        <a class="btn" href="<?= $base ?>/sale_items/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/sale_items/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar ítem?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
