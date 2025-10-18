<h2>Nuevo Horario</h2>

<form method="post" action="<?= $base ?>/schedules/store" class="form">
  <label>Ruta
    <select name="route_id" required>
      <option value="">-- Seleccionar Ruta --</option>
      <?php foreach ($routes as $r): ?>
        <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Día de la semana
    <select name="day_of_week" required>
      <?php foreach (["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"] as $i => $d): ?>
        <option value="<?= $i ?>"><?= $d ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Hora de inicio
    <input type="time" name="start_time" required>
  </label>

  <label>Hora de fin
    <input type="time" name="end_time" required>
  </label>

  <button class="btn">Guardar</button>
</form>
