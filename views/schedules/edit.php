<h2>Editar Horario #<?= $item['id'] ?></h2>

<form method="post" action="<?= $base ?>/schedules/update" class="form">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">

  <label>Ruta
    <select name="route_id" required>
      <?php foreach ($routes as $r): ?>
        <option value="<?= $r['id'] ?>" <?= $r['id']==$item['route_id']?'selected':'' ?>>
          <?= htmlspecialchars($r['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Día de la semana
    <select name="day_of_week" required>
      <?php foreach (["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"] as $i => $d): ?>
        <option value="<?= $i ?>" <?= $item['day_of_week']==$i?'selected':'' ?>><?= $d ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Hora de inicio
    <input type="time" name="start_time" value="<?= htmlspecialchars($item['start_time']) ?>" required>
  </label>

  <label>Hora de fin
    <input type="time" name="end_time" value="<?= htmlspecialchars($item['end_time']) ?>" required>
  </label>

  <button class="btn">Actualizar</button>
</form>
