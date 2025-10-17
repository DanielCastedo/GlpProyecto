<h2>Products</h2>
<p><a class="btn" href="<?= $base ?>/products/create">Nuevo</a></p>

<table>
  <thead><tr><th>Name</th><th>Sku</th><th>Cylinder_weight_kg</th><th>Price</th><th>Acciones</th></tr></thead>
  <tbody>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name'] ?? '') ?></td><td><?= htmlspecialchars($row['sku'] ?? '') ?></td><td><?= htmlspecialchars($row['cylinder_weight_kg'] ?? '') ?></td><td><?= htmlspecialchars($row['price'] ?? '') ?></td>
      <td>
        <a class="btn" href="<?= $base ?>/products/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/products/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
