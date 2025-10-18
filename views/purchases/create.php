<h2 style="margin-bottom:22px;">🧾 Nueva Compra</h2>

<form method="post" action="<?= $base ?>/purchases/store" class="purchase-form">
  <div class="form-grid">
    <div class="field field--4">
      <label class="label">Fecha</label>
      <input type="date" name="date" class="input" value="<?= date('Y-m-d') ?>" required>
    </div>

    <div class="field field--8">
      <label class="label">Proveedor</label>
      <input type="text" name="supplier" class="input" placeholder="Nombre del proveedor" required>
    </div>

    <div class="field field--6">
      <label class="label">Chofer</label>
      <select name="driver_id" class="select" required>
        <option value="">-- Seleccione Chofer --</option>
        <?php foreach ($drivers as $d): ?>
          <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="field field--6">
      <label class="label">Camión</label>
      <select name="truck_id" class="select" required>
        <option value="">-- Seleccione Camión --</option>
        <?php foreach ($trucks as $t): ?>
          <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['plate']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div style="margin-top:20px;">
    <button type="submit" class="btn">💾 Guardar Compra</button>
    <a href="<?= $base ?>/purchases" class="btn btn-ghost">↩️ Cancelar</a>
  </div>
</form>

<style>
  .purchase-form {
    background: #fff;
    border-radius: 12px;
    padding: 24px 20px;
    box-shadow: 0 2px 16px rgba(33, 150, 243, 0.08);
    margin-top: 14px;
  }

  .form-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 16px;
  }

  .field {
    grid-column: span 12;
  }

  .field--4 {
    grid-column: span 12;
  }

  .field--6 {
    grid-column: span 12;
  }

  .field--8 {
    grid-column: span 12;
  }

  @media(min-width: 700px) {
    .field--4 { grid-column: span 4; }
    .field--6 { grid-column: span 6; }
    .field--8 { grid-column: span 8; }
  }

  .label {
    display: block;
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 6px;
    color: #374151;
  }

  .input,
  .select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #d0d7de;
    font-size: 1rem;
    transition: border-color 0.17s ease, box-shadow 0.17s ease;
  }

  .input:focus,
  .select:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 4px rgba(25, 118, 210, 0.15);
    outline: none;
  }

  .btn {
    background: #1976d2;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .18s, box-shadow .17s;
    text-decoration: none;
    display: inline-block;
  }

  .btn:hover,
  .btn:focus {
    background: #135ba1;
    box-shadow: 0 2px 10px rgba(25, 118, 210, 0.12);
  }

  .btn-ghost {
    background: #e9eef9;
    color: #1e3a8a;
    margin-left: 6px;
  }

  .btn-ghost:hover {
    background: #cbd5e1;
  }
</style>
