<h2 style="margin-bottom:20px; font-size:1.18rem; font-weight:700;">Editar Horario #<?= $item['id'] ?></h2>

<form method="post" action="<?= $base ?>/schedules/update" class="schedule-form">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">

  <div class="schedule-form-grid">
    <label>
      <span>Ruta</span>
      <select name="route_id" required>
        <?php foreach ($routes as $r): ?>
          <option value="<?= $r['id'] ?>" <?= $r['id']==$item['route_id']?'selected':'' ?>>
            <?= htmlspecialchars($r['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>

    <label>
      <span>Día de la semana</span>
      <select name="day_of_week" required>
        <?php foreach (["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"] as $i => $d): ?>
          <option value="<?= $i ?>" <?= $item['day_of_week']==$i?'selected':'' ?>><?= $d ?></option>
        <?php endforeach; ?>
      </select>
    </label>

    <label>
      <span>Hora de inicio</span>
      <input type="time" name="start_time" value="<?= htmlspecialchars($item['start_time']) ?>" required>
    </label>

    <label>
      <span>Hora de fin</span>
      <input type="time" name="end_time" value="<?= htmlspecialchars($item['end_time']) ?>" required>
    </label>
  </div>
  <button class="btn btn-primary" type="submit">Actualizar</button>
</form>

<style>
.schedule-form {
  background: #fff;
  border-radius: 13px;
  box-shadow: 0 2px 14px rgba(33,150,243,0.09);
  padding: 28px 26px 18px 26px;
  max-width: 480px;
  margin: 0 auto 32px auto;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.schedule-form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 18px 22px;
}

.schedule-form label {
  display: flex;
  flex-direction: column;
  background: #f8fafc;
  border-radius: 8px;
  padding: 14px 12px 10px 12px;
  font-size: 1rem;
  color: #1976d2;
  font-weight: 600;
  gap: 6px;
  border: 1.2px solid #e0e7ef;
  box-shadow: 0 1px 6px rgba(33,150,243,0.04);
}

.schedule-form label span {
  font-size: 0.97rem;
  color: #374151;
  font-weight: 500;
  margin-bottom: 3px;
}

.schedule-form input,
.schedule-form select {
  margin-top: 2px;
  padding: 7px 11px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.04rem;
  background: #f9fcff;
  transition: border-color .18s;
}
.schedule-form input:focus,
.schedule-form select:focus {
  border-color: #1976d2;
  outline: none;
}

.btn.btn-primary {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 11px 32px;
  border-radius: 8px;
  font-size: 1.09rem;
  cursor: pointer;
  font-weight: 600;
  box-shadow: 0 1px 8px rgba(25,118,210,0.11);
  transition: background .18s, box-shadow .17s;
  margin: 24px auto 0 auto;
  display: block;
}
.btn.btn-primary:hover,
.btn.btn-primary:focus {
  background: #135ba1;
}

/* Responsive */
@media (max-width: 700px) {
  .schedule-form {
    padding: 14px 8px 12px 8px;
    max-width: 99vw;
  }
  .schedule-form-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  .btn.btn-primary {
    width: 100%;
    padding: 11px 0;
    margin-top: 18px;
  }
}
</style>