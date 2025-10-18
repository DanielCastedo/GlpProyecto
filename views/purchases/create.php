<h2>Nueva Compra</h2>
<form method="post" action="<?= $base ?>/purchases/store" class="form">
  <label>Fecha <input type="date" name="date" value="<?= date('Y-m-d') ?>"></label>
  <label>Proveedor <input type="text" name="supplier" required></label>

  <label>Chofer
    <select name="driver_id">
      <option value="">--Seleccione--</option>
      <?php foreach ($drivers as $d): ?>
        <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Camión
    <select name="truck_id">
      <option value="">--Seleccione--</option>
      <?php foreach ($trucks as $t): ?>
        <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['plate']) ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <button class="btn">Guardar</button>
</form>
