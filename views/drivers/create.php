<a href="<?= $base ?>/drivers" class="btn btn-back" style="margin-bottom:18px;">
  ← Volver
</a>

<h2 style="margin-bottom:24px;">Nuevo chofer</h2>

<form method="post" action="<?= $base ?>/drivers/store" class="driver-new-form">
  <div class="driver-new-grid">
    <label>
      <span>Nombre</span>
      <input name="name" required placeholder="Ej: Juan Pérez">
    </label>
    <label>
      <span>Teléfono</span>
      <input name="phone" required placeholder="Ej: 78912345">
    </label>
    <label>
      <span>Licencia</span>
      <input name="license" required placeholder="Ej: ABC12345">
    </label>
    <label>
      <span>Camión</span>
      <select name="truck_id" required>
        <option value="">-- Seleccionar camión --</option>
        <?php foreach ($trucks as $truck): ?>
          <option value="<?= $truck['id'] ?>">
            <?= htmlspecialchars($truck['name'] ?? 'Camión ' . $truck['id']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
  </div>
  <button class="btn btn-primary" type="submit">Guardar</button>
</form>

<style>
.btn-back {
  background: #fff;
  color: #1976d2;
  border: 2px solid #1976d2;
  padding: 8px 22px;
  border-radius: 8px;
  font-size: 1.02rem;
  font-weight: 600;
  box-shadow: 0 1px 8px rgba(25,118,210,0.05);
  display: inline-block;
  transition: background .18s, color .18s, border .18s;
  margin-bottom: 8px;
}
.btn-back:hover, .btn-back:focus {
  background: #1976d2;
  color: #fff;
}
.driver-new-form {
  background: #f5f8fd;
  border-radius: 15px;
  box-shadow: 0 1px 12px rgba(33,150,243,0.08);
  padding: 28px 26px 18px 26px;
  max-width: 480px;
  margin: 0 auto 32px auto;
  display: flex;
  flex-direction: column;
  gap: 22px;
}
.driver-new-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.driver-new-form label {
  display: flex;
  flex-direction: column;
  background: #fff;
  border-radius: 8px;
  padding: 16px 14px;
  box-shadow: 0 1px 8px rgba(25,118,210,0.06);
  font-size: 1rem;
  color: #1976d2;
  font-weight: 600;
  gap: 6px;
}
.driver-new-form input,
.driver-new-form select {
  margin-top: 2px;
  padding: 8px 12px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.03rem;
  background: #f9fcff;
  transition: border-color .18s;
}
.driver-new-form input:focus,
.driver-new-form select:focus {
  border-color: #1976d2;
  outline: none;
}
.btn, .btn-primary {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 11px 32px;
  border-radius: 8px;
  font-size: 1.09rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 600;
  box-shadow: 0 1px 8px rgba(25,118,210,0.11);
  transition: background .18s, box-shadow .17s;
  margin-top: 18px;
  align-self: center;
}
.btn-primary:hover, .btn-primary:focus, .btn:hover, .btn:focus {
  background: #135ba1;
}

/* Responsive: móvil/tablet */
@media (max-width: 900px) {
  .driver-new-form {
    padding: 15px 2vw 14px 2vw;
    max-width: 97vw;
  }
  .driver-new-grid {
    grid-template-columns: 1fr;
    gap: 14px;
  }
  .btn, .btn-primary, .btn-back {
    width: 100%;
    padding: 11px 0;
    margin-top: 18px;
    align-self: stretch;
    font-size: 1.07rem;
  }
}
</style>