<h2 style="margin-bottom:20px; font-size:1.22rem; font-weight:700;">Nuevo Camión</h2>
<div class="truck-form-container">
  <form method="post" action="<?= $base ?>/trucks/store" class="truck-form">
    <div class="truck-form-grid">
      <label>
        <span>Placa</span>
        <input name="plate" required placeholder="Ej: 1234ABC">
      </label>
      <label>
        <span>Modelo</span>
        <input name="model" required placeholder="Ej: Volvo FH">
      </label>
      <label>
        <span>Capacidad (unidades)</span>
        <input name="capacity_units" required placeholder="Ej: 45">
      </label>
    </div>
    <div class="truck-form-actions">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a href="<?= $base ?>/trucks" class="btn btn-ghost" type="button">← Volver</a>
    </div>
  </form>
</div>

<style>
.truck-form-container {
  width: 100%;
  max-width: 420px;
  margin: 0 auto 32px auto;
  padding: 0 12px;
}

.truck-form {
  background: #fff;
  border-radius: 13px;
  box-shadow: 0 2px 14px rgba(33,150,243,0.09);
  padding: 28px 22px 18px 22px;
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.truck-form-grid {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.truck-form label {
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

.truck-form label span {
  font-size: 0.97rem;
  color: #374151;
  font-weight: 500;
  margin-bottom: 3px;
}

.truck-form input {
  margin-top: 2px;
  padding: 7px 11px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.04rem;
  background: #f9fcff;
  transition: border-color .18s;
}

.truck-form input:focus {
  border-color: #1976d2;
  outline: none;
}

.truck-form-actions {
  display: flex;
  gap: 14px;
  justify-content: flex-end;
  margin-top: 16px;
}

.btn {
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
  text-decoration: none;
  display: inline-block;
}
.btn.btn-primary:hover,
.btn.btn-primary:focus {
  background: #135ba1;
}
.btn-ghost {
  background: #eaf4fc;
  color: #1976d2;
  border: 2px solid #1976d2;
  padding: 11px 28px;
}
.btn-ghost:hover,
.btn-ghost:focus {
  background: #d8eafd;
  color: #135ba1;
  border-color: #135ba1;
}

@media (max-width: 700px) {
  .truck-form-container {
    max-width: 99vw;
    padding: 0 4vw;
  }
  .truck-form {
    padding: 14px 4vw 12px 4vw;
    min-width: unset;
    max-width: 99vw;
  }
  .truck-form-actions {
    flex-direction: column-reverse;
    gap: 8px;
    margin-top: 8px;
  }
  .btn, .btn-ghost {
    width: 100%;
    padding: 11px 0;
    margin-top: 0;
  }
}
</style>