<h2>Routes</h2>
<p><a class="btn" href="{<?= '$base' ?>}/routes/create">Nuevo</a></p>
<table>
  <thead><tr><th>Name</th><th>Description</th><th>Acciones</th></tr></thead>
  <tbody>
  <?php foreach ($items as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name'] ?? '') ?></td><td><?= htmlspecialchars($row['description'] ?? '') ?></td>
      <td>
        <a class="btn" href="{<?= '$base' ?>}/routes/edit?id=<?= $row['id'] ?>">Editar</a>
        <form method="post" action="{<?= '$base' ?>}/routes/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
