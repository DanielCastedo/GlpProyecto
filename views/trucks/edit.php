<h2 class="truck-edit-title">✏️ Editar camión #<?= htmlspecialchars($item['id'] ?? '') ?></h2>

<form method="post" action="<?= $base ?>/trucks/update" class="form truck-edit-form" autocomplete="off">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">

  <table class="truck-form-table">
    <tr>
      <th>Placa</th>
      <td>
        <input name="plate" value="<?= htmlspecialchars($item['plate'] ?? '') ?>" required>
      </td>
    </tr>
    <tr>
      <th>Modelo</th>
      <td>
        <input name="model" value="<?= htmlspecialchars($item['model'] ?? '') ?>" required>
      </td>
    </tr>
    <tr>
      <th>Capacidad</th>
      <td>
        <input name="capacity_units" value="<?= htmlspecialchars($item['capacity_units'] ?? '') ?>" required>
      </td>
    </tr>
  </table>

  <button class="btn btn-primary" type="submit">Actualizar</button>
</form>

<style>
.truck-edit-title {
  margin-bottom: 18px;
  color: #1976d2;
  font-size: 1.7rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 8px;
}
.truck-edit-form {
  background: #f7fafd;
  border-radius: 13px;
  box-shadow: 0 1px 12px rgba(33,150,243,0.07);
  padding: 30px 24px 20px 24px;
  max-width: 410px;
  margin: 0 auto 34px auto;
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.truck-form-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 1px 6px rgba(25,118,210,0.07);
  margin-bottom: 12px;
  overflow: hidden;
}
.truck-form-table th, .truck-form-table td {
  font-size: 1.07rem;
  text-align: left;
  padding: 13px 10px 13px 16px;
  border-bottom: 1px solid #eef1f5;
}
.truck-form-table th {
  background: #f6faff;
  color: #1976d2;
  font-weight: 700;
  min-width: 120px;
  width: 35%;
  border-right: 1px solid #e0eaf7;
}
.truck-form-table tr:last-child th, .truck-form-table tr:last-child td {
  border-bottom: none;
}
.truck-form-table td {
  background: #fcfdff;
}
.truck-edit-form input {
  padding: 9px 13px;
  border-radius: 8px;
  border: 1px solid #d0d7de;
  font-size: 1.09rem;
  background: #f9fcff;
  transition: border-color .16s;
  width: 100%;
  box-sizing: border-box;
}
.truck-edit-form input:focus {
  border-color: #1976d2;
  outline: none;
}
.btn, .btn-primary {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 12px 36px;
  border-radius: 9px;
  font-size: 1.11rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 600;
  box-shadow: 0 1px 8px rgba(25,118,210,0.09);
  transition: background .17s, box-shadow .14s;
  margin-top: 18px;
  align-self: center;
}
.btn-primary:hover, .btn-primary:focus, .btn:hover, .btn:focus {
  background: #135ba1;
}

/* Responsive */
@media (max-width: 700px) {
  .truck-edit-form {
    padding: 12px 2vw 10px 2vw;
    max-width: 99vw;
  }
  .truck-form-table th, .truck-form-table td {
    padding: 10px 6px;
    font-size: 1.01rem;
  }
  .btn, .btn-primary {
    width: 100%;
    padding: 12px 0;
    margin-top: 16px;
    align-self: stretch;
    font-size: 1.07rem;
  }
}
</style>