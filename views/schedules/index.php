<h2>Horarios</h2>

<a class="btn" href="<?= $base ?>/schedules/create">Nuevo Horario</a>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Ruta</th>
      <th>Día</th>
      <th>Inicio</th>
      <th>Fin</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($items as $item): ?>
    <tr>
      <td><?= $item['id'] ?></td>
      <td><?= htmlspecialchars($item['route_name']) ?></td>
      <td><?= ["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"][$item['day_of_week']] ?></td>
      <td><?= htmlspecialchars($item['start_time']) ?></td>
      <td><?= htmlspecialchars($item['end_time']) ?></td>
      <td>
        <a class="btn" href="<?= $base ?>/schedules/edit?id=<?= $item['id'] ?>">Editar</a>
        <form method="post" action="<?= $base ?>/schedules/destroy" style="display:inline" onsubmit="return confirm('¿Eliminar horario?')">
          <input type="hidden" name="id" value="<?= $item['id'] ?>">
          <button class="btn btn-danger">Eliminar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
