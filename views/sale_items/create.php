<h2 style="margin-bottom:12px;">
  Agregar ítem a venta #<?= $sale_id ?>
</h2>

<?php if (!empty($sale)): ?>
<div class="cliente-info">
  <strong>Cliente:</strong> <?= htmlspecialchars($sale['customer_name']) ?><br>
  <strong>Teléfono:</strong> <?= htmlspecialchars($sale['customer_phone']) ?>
</div>
<?php endif; ?>

<form method="post" action="<?= $base ?>/sale_items/store" class="item-add-form"
      oninput="subtotal.value = (qty.valueAsNumber||0)*(unit_price.valueAsNumber||0)">
  <input type="hidden" name="sale_id" value="<?= $sale_id ?>">

  <div class="item-add-grid">
    <label>
      <span>Producto</span>
      <select name="product_id" id="product_id" required onchange="setUnitPrice()">
        <option value="">-- seleccionar --</option>
        <?php foreach ($products as $p): ?>
          <option value="<?= $p['id'] ?>" data-price="<?= $p['price'] ?>">
            <?= htmlspecialchars($p['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <label>
      <span>Cantidad</span>
      <input type="number" name="qty" id="qty" min="1" value="1" required>
    </label>
    <label>
      <span>Precio unitario</span>
      <input type="number" name="unit_price" id="unit_price" step="0.01" min="0" required>
    </label>
    <label>
      <span>Subtotal</span>
      <input type="number" name="subtotal" id="subtotal" step="0.01" min="0" readonly>
    </label>
  </div>
  <button class="btn btn-primary" type="submit">Guardar</button>
</form>

<a class="btn btn-back" href="<?= $base ?>/sale_items?sale_id=<?= $sale_id ?>" style="margin-top:20px;">
  ← Volver a ítems de venta
</a>

<script>
// Pasa los productos y precios a JS
const productos = <?= json_encode($products, JSON_NUMERIC_CHECK) ?>;

// Coloca el precio automáticamente al seleccionar producto
function setUnitPrice() {
  const select = document.getElementById('product_id');
  const selected = select.options[select.selectedIndex];
  const price = selected.getAttribute('data-price');
  if(price !== null && price !== "") {
    document.getElementById('unit_price').value = price;
    calcularSubtotal();
  }
}

// Calcula el subtotal automáticamente cuando cambia cantidad o precio
function calcularSubtotal() {
  const qty = document.getElementById('qty').valueAsNumber || 0;
  const price = document.getElementById('unit_price').valueAsNumber || 0;
  document.getElementById('subtotal').value = (qty * price).toFixed(2);
}

// Eventos para recalcular subtotal al cambiar qty o unit_price
document.getElementById('qty').addEventListener('input', calcularSubtotal);
document.getElementById('unit_price').addEventListener('input', calcularSubtotal);
</script>

<style>
.cliente-info {
  background: #e3f1ff;
  color: #1565c0;
  border-radius: 8px;
  padding: 11px 20px;
  margin-bottom: 18px;
  font-size: 1.1rem;
  box-shadow: 0 1px 8px rgba(33,150,243,0.08);
}
.item-add-form {
  background: #f5f8fd;
  border-radius: 15px;
  box-shadow: 0 1px 12px rgba(33,150,243,0.09);
  padding: 28px 26px 18px 26px;
  max-width: 460px;
  margin: 0 auto 32px auto;
  display: flex;
  flex-direction: column;
  gap: 22px;
}
.item-add-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.item-add-form label {
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
.item-add-form input,
.item-add-form select {
  margin-top: 2px;
  padding: 8px 12px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.03rem;
  background: #f9fcff;
  transition: border-color .18s;
}
.item-add-form input:focus,
.item-add-form select:focus {
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
}
.btn-back:hover, .btn-back:focus {
  background: #1976d2;
  color: #fff;
}

/* Responsive: móvil/tablet */
@media (max-width: 700px) {
  .item-add-form {
    padding: 15px 2vw 14px 2vw;
    max-width: 99vw;
  }
  .item-add-grid {
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