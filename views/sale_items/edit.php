<h2 class="venta-title">
  <span>📝</span> Editar ítem #<?= $item['id'] ?> <span style="font-weight:400;">(venta #<?= $item['sale_id'] ?>)</span>
</h2>

<form method="post" action="<?= $base ?>/sale_items/update" class="item-edit-form" autocomplete="off">
  <input type="hidden" name="id" value="<?= $item['id'] ?>">
  <input type="hidden" name="sale_id" value="<?= $item['sale_id'] ?>">

  <table class="item-form-table">
    <tr>
      <th>Producto</th>
      <td>
        <select name="product_id" id="product_id"
                required onchange="setUnitPriceAndSubtotal()">
          <?php foreach ($products as $p): ?>
            <option value="<?= $p['id'] ?>"
              data-price="<?= $p['price'] ?>"
              <?= $p['id']==$item['product_id']?'selected':'' ?>>
              <?= htmlspecialchars($p['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
      <th>Cantidad</th>
      <td>
        <input type="number" name="qty" id="qty" min="1"
               value="<?= htmlspecialchars($item['qty']) ?>" required>
      </td>
    </tr>
    <tr>
      <th>Precio unitario</th>
      <td>
        <input type="number" name="unit_price" id="unit_price" step="0.01" min="0"
               value="<?= htmlspecialchars($item['unit_price']) ?>" required>
      </td>
    </tr>
    <tr>
      <th>Subtotal</th>
      <td>
        <input type="number" name="subtotal" id="subtotal" step="0.01" min="0"
               value="<?= htmlspecialchars($item['subtotal']) ?>" readonly>
      </td>
    </tr>
  </table>
  <button class="btn btn-primary" type="submit">Actualizar</button>
</form>

<a class="btn btn-back" href="<?= $base ?>/sale_items?sale_id=<?= $item['sale_id'] ?>" style="margin-top:23px;">
  ← Volver a ítems de venta
</a>

<script>
const productos = <?= json_encode($products, JSON_NUMERIC_CHECK) ?>;

// Si cambias el producto, pone el precio de ese producto y recalcula subtotal
function setUnitPriceAndSubtotal() {
  const select = document.getElementById('product_id');
  const selected = select.options[select.selectedIndex];
  const price = selected.getAttribute('data-price');
  if(price !== null && price !== "") {
    document.getElementById('unit_price').value = price;
  }
  calcularSubtotal();
}
// Recalcula el subtotal cuando cambian cantidad o precio
function calcularSubtotal() {
  const qty = document.getElementById('qty').valueAsNumber || 0;
  const price = document.getElementById('unit_price').valueAsNumber || 0;
  document.getElementById('subtotal').value = (qty * price).toFixed(2);
}
document.getElementById('qty').addEventListener('input', calcularSubtotal);
document.getElementById('unit_price').addEventListener('input', calcularSubtotal);
</script>

<style>
.venta-title {
  margin-bottom: 18px;
  color: #1976d2;
  font-size: 1.7rem;
  font-weight: 700;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.item-edit-form {
  background: #f7fafd;
  border-radius: 13px;
  box-shadow: 0 1px 12px rgba(33,150,243,0.08);
  padding: 30px 24px 20px 24px;
  max-width: 480px;
  margin: 0 auto 32px auto;
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.item-form-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 1px 6px rgba(25,118,210,0.07);
  margin-bottom: 12px;
  overflow: hidden;
}
.item-form-table th, .item-form-table td {
  font-size: 1.07rem;
  text-align: left;
  padding: 13px 10px 13px 16px;
  border-bottom: 1px solid #eef1f5;
}
.item-form-table th {
  background: #f6faff;
  color: #1976d2;
  font-weight: 700;
  min-width: 135px;
  width: 35%;
  border-right: 1px solid #e0eaf7;
}
.item-form-table tr:last-child th, .item-form-table tr:last-child td {
  border-bottom: none;
}
.item-form-table td {
  background: #fcfdff;
}
.item-edit-form input,
.item-edit-form select {
  padding: 9px 13px;
  border-radius: 8px;
  border: 1px solid #d0d7de;
  font-size: 1.09rem;
  background: #f9fcff;
  transition: border-color .16s;
  width: 100%;
  box-sizing: border-box;
}
.item-edit-form input:focus,
.item-edit-form select:focus {
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
.btn-back {
  background: #fff;
  color: #1976d2;
  border: 2px solid #1976d2;
  font-weight: 600;
  border-radius: 8px;
  padding: 10px 22px;
  font-size: 1.03rem;
  transition: background .18s, color .18s, border .18s;
  display: inline-block;
  margin-top: 5px;
}
.btn-back:hover, .btn-back:focus {
  background: #dbeafe;
  color: #1976d2;
}
@media (max-width: 700px) {
  .item-edit-form {
    padding: 12px 2vw 10px 2vw;
    max-width: 99vw;
  }
  .item-form-table th, .item-form-table td {
    padding: 10px 6px;
    font-size: 1.01rem;
  }
  .btn, .btn-primary, .btn-back {
    width: 100%;
    padding: 12px 0;
    margin-top: 16px;
    align-self: stretch;
    font-size: 1.07rem;
  }
}
</style>