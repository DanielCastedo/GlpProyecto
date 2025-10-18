<h2 class="driver-edit-title">🚚 Editar chofer #<?= htmlspecialchars($item['id'] ?? '') ?></h2>

<form method="post" action="<?= $base ?>/drivers/update" class="form driver-edit-form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">

  <table class="driver-form-table">
    <tr>
      <th>Nombre</th>
      <td>
        <input name="name" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required>
      </td>
    </tr>
    <tr>
      <th>Teléfono</th>
      <td>
        <input name="phone" value="<?= htmlspecialchars($item['phone'] ?? '') ?>" required>
      </td>
    </tr>
    <tr>
      <th>Licencia</th>
      <td>
        <input name="license" value="<?= htmlspecialchars($item['license'] ?? '') ?>" required>
      </td>
    </tr>
    <tr>
      <th>Camión ID</th>
      <td>
        <input name="truck_id" value="<?= htmlspecialchars($item['truck_id'] ?? '') ?>" required>
      </td>
    </tr>
  </table>

  <button class="btn btn-primary" type="submit">Actualizar</button>
</form>

<style>
.driver-edit-title {
  margin-bottom: 18px;
  color: #1976d2;
  font-size: 1.7rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
}
.driver-edit-form {
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
.driver-form-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 1px 6px rgba(25,118,210,0.07);
  margin-bottom: 12px;
  overflow: hidden;
}
.driver-form-table th, .driver-form-table td {
  font-size: 1.07rem;
  text-align: left;
  padding: 13px 10px 13px 16px;
  border-bottom: 1px solid #eef1f5;
}
.driver-form-table th {
  background: #f6faff;
  color: #1976d2;
  font-weight: 700;
  min-width: 120px;
  width: 35%;
  border-right: 1px solid #e0eaf7;
}
.driver-form-table tr:last-child th, .driver-form-table tr:last-child td {
  border-bottom: none;
}
.driver-form-table td {
  background: #fcfdff;
}
.driver-edit-form input {
  padding: 9px 13px;
  border-radius: 8px;
  border: 1px solid #d0d7de;
  font-size: 1.09rem;
  background: #f9fcff;
  transition: border-color .16s;
  width: 100%;
  box-sizing: border-box;
}
.driver-edit-form input:focus {
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
  .driver-edit-form {
    padding: 12px 2vw 10px 2vw;
    max-width: 99vw;
  }
  .driver-form-table th, .driver-form-table td {
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