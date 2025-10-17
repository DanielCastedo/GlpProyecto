<h2>Trucks</h2>
<p><a class="btn" href="{<?= '$base' ?>}/trucks/create">Nuevo</a></p>
<table>
  <thead><tr><th>Plate</th><th>Model</th><th>Capacity_units</th><th>Acciones</th></tr></thead>
  <tbody>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['plate'] ?? '') ?></td><td><?= htmlspecialchars($row['model'] ?? '') ?></td><td><?= htmlspecialchars($row['capacity_units'] ?? '') ?></td>
      <td>
        <a class="btn" href="{<?= '$base' ?>}/trucks/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="{<?= '$base' ?>}/trucks/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
