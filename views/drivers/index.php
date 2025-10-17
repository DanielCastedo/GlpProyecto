<h2>Drivers</h2>
<p><a class="btn" href="{<?= '$base' ?>}/drivers/create">Nuevo</a></p>
<table>
  <thead><tr><th>Name</th><th>Phone</th><th>License</th><th>Truck_id</th><th>Acciones</th></tr></thead>
  <tbody>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name'] ?? '') ?></td><td><?= htmlspecialchars($row['phone'] ?? '') ?></td><td><?= htmlspecialchars($row['license'] ?? '') ?></td><td><?= htmlspecialchars($row['truck_id'] ?? '') ?></td>
      <td>
        <a class="btn" href="{<?= '$base' ?>}/drivers/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="{<?= '$base' ?>}/drivers/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
