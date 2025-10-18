<h2 class="venta-title">
  <span>🛒</span> Agregar ítems a venta #<?= $sale_id ?>
</h2>

<?php if (!empty($sale)): ?>
<div class="cliente-info">
  <span class="cliente-label">👤 Cliente:</span> <?= htmlspecialchars($sale['customer_name']) ?>
  <span class="cliente-label">📞</span> <?= htmlspecialchars($sale['customer_phone']) ?>
</div>
<?php endif; ?>

<form method="post" action="<?= $base ?>/sale_items/store_multiple" class="item-add-form" id="multiItemsForm" autocomplete="off">
  <input type="hidden" name="sale_id" value="<?= $sale_id ?>">

  <div class="items-table-wrap">
    <div class="table-responsive">
      <table class="items-table">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="itemsBody">
          <!-- JS agregará filas aquí -->
        </tbody>
      </table>
    </div>
    <button type="button" class="btn btn-secondary btn-add-row" onclick="agregarItem()">+ Agregar producto</button>
  </div>
  <div class="venta-total">
    <div class="venta-total-label">Total</div>
    <input id="totalVenta" type="number" step="0.01" value="0" readonly>
  </div>
  <button class="btn btn-primary" type="submit">💾 Guardar ítems</button>
</form>

<a class="btn btn-back" href="<?= $base ?>/sale_items?sale_id=<?= $sale_id ?>">
  ← Volver a ítems de venta
</a>

<script>
const productos = <?= json_encode($products, JSON_NUMERIC_CHECK) ?>;

function agregarItem() {
  const idx = document.querySelectorAll('#itemsBody tr').length;
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td>
      <select name="items[${idx}][product_id]" class="prod-select" required onchange="setUnitPrice(this)">
        <option value="">-- seleccionar --</option>
        ${productos.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`).join('')}
      </select>
    </td>
    <td>
      <input name="items[${idx}][qty]" type="number" min="1" value="1" required 
        onchange="calcularFila(this)" oninput="calcularFila(this)" class="input-sm">
    </td>
    <td>
      <input name="items[${idx}][unit_price]" type="number" min="0" step="0.01" value="0" required 
        readonly tabindex="-1" class="input-sm input-readonly">
    </td>
    <td>
      <input name="items[${idx}][subtotal]" type="number" min="0" step="0.01" value="0" readonly class="input-sm input-total">
    </td>
    <td>
      <button type="button" class="btn btn-danger btn-sm" title="Quitar" onclick="this.closest('tr').remove(); calcularTotal()">
        🗑️
      </button>
    </td>
  `;
  document.getElementById('itemsBody').appendChild(tr);
  calcularTotal();
}

// Al seleccionar el producto, pone el precio automáticamente y recalcula
function setUnitPrice(select) {
  const price = select.options[select.selectedIndex].getAttribute('data-price');
  const unitPriceInput = select.closest('tr').querySelector('input[name$="[unit_price]"]');
  if (price !== null && price !== "") {
    unitPriceInput.value = price;
    calcularFila(unitPriceInput);
  }
}

// Cuando cambia cantidad recalcula el subtotal y el total
function calcularFila(input) {
  const tr = input.closest('tr');
  const qty = tr.querySelector('input[name$="[qty]"]').valueAsNumber || 0;
  const price = tr.querySelector('input[name$="[unit_price]"]').valueAsNumber || 0;
  tr.querySelector('input[name$="[subtotal]"]').value = (qty * price).toFixed(2);
  calcularTotal();
}

// Recalcula el total de todos los ítems
function calcularTotal() {
  let total = 0;
  document.querySelectorAll('#itemsBody tr').forEach(tr => {
    total += parseFloat(tr.querySelector('input[name$="[subtotal]"]').value) || 0;
  });
  document.getElementById('totalVenta').value = total.toFixed(2);
}

// Inicial: agrega una fila por defecto
window.addEventListener('DOMContentLoaded', agregarItem);
</script>

<style>
.venta-title {
  margin-bottom: 16px;
  color: #1565c0;
  font-size: 2rem;
  font-weight: 700;
  letter-spacing: 1.2px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.cliente-info {
  background: #edf6fd;
  color: #2176b6;
  border-radius: 10px;
  padding: 13px 22px;
  margin-bottom: 22px;
  font-size: 1.13rem;
  display: flex;
  align-items: center;
  gap: 18px;
  box-shadow: 0 2px 10px rgba(33,150,243,0.07);
}
.cliente-label { font-weight: bold; margin-right: 2px; }
.item-add-form {
  background: #f7fafd;
  border-radius: 15px;
  box-shadow: 0 1px 16px rgba(33,150,243,0.09);
  padding: 32px 30px 24px 30px;
  max-width: 900px;
  margin: 0 auto 36px auto;
  display: flex;
  flex-direction: column;
  gap: 22px;
}
.items-table-wrap {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 1px 8px rgba(25,118,210,0.04);
  padding: 16px 10px 10px 10px;
  margin-bottom: 18px;
  overflow-x: auto;
}
.table-responsive {
  width: 100%;
  overflow-x: auto;
}
.items-table {
  width: 100%;
  min-width: 650px;
  border-collapse: separate;
  border-spacing: 0;
  margin-bottom: 10px;
  border-radius: 8px;
  overflow: hidden;
  background: #fafdff;
  box-shadow: 0 1px 3px rgba(25,118,210,0.05);
}
.items-table th {
  background: linear-gradient(90deg, #e8f1fb 90%, #f4faff 100%);
  color: #1976d2;
  font-weight: 700;
  padding: 13px 8px;
  font-size: 1.08rem;
  text-align: left;
  border: none;
  border-bottom: 2px solid #b3c6e4;
  letter-spacing: 0.5px;
}
.items-table tr {
  transition: background 0.13s;
}
.items-table tr:hover td {
  background: #f0f7fc;
}
.items-table td {
  padding: 10px 8px;
  border-bottom: 1px solid #e8eef6;
  vertical-align: middle;
  background: #fcfdff;
  font-size: 1.04rem;
}
.items-table td:last-child { text-align: center; }
.items-table tr:last-child td { border-bottom: none; }
.input-sm {
  max-width: 82px;
  font-size: 1.10rem;
  padding: 7px 7px;
  border: 1px solid #d0d7de;
  border-radius: 6px;
  background: #f9fcff;
  transition: border-color .18s;
}
.input-sm:focus { border-color: #1976d2; outline: none; }
.input-readonly {
  background: #eaf3fa;
  color: #1976d2;
  cursor: not-allowed;
}
.input-total {
  color: #2176b6;
  font-weight: 700;
  background: #edf6fd;
  border: none;
}
.prod-select {
  min-width: 155px;
  font-size: 1.08rem;
  border: 1px solid #d0d7de;
  border-radius: 6px;
  background: #f9fcff;
  padding: 7px 7px;
  transition: border-color .18s;
}
.prod-select:focus { border-color: #1976d2; outline: none; }
.btn-add-row {
  margin-top: 10px;
  margin-bottom: 0;
  padding: 7px 18px;
  border-radius: 6px;
  font-size: 1rem;
  background: #b9e6fc;
  color: #1976d2;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: background .16s, color .16s;
  box-shadow: 0 2px 10px rgba(33,150,243,0.06);
}
.btn-add-row:hover { background: #d3f0ff; color: #135ba1; }
.btn-sm {
  padding: 5px 13px;
  font-size: 1.02rem;
  border-radius: 6px;
  box-shadow: 0 1px 4px rgba(229,57,53,0.10);
}
.btn-danger { background: #f6a6a6 !important; color: #c92d2d !important; }
.btn-danger:hover, .btn-danger:focus { background: #ffe0e0 !important; color: #b71c1c !important; }
.btn-primary {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 13px 38px;
  border-radius: 10px;
  font-size: 1.13rem;
  cursor: pointer;
  text-decoration: none;
  font-weight: 700;
  box-shadow: 0 1px 8px rgba(25,118,210,0.08);
  transition: background .17s, box-shadow .16s;
  margin-top: 18px;
  align-self: center;
}
.btn-primary:hover, .btn-primary:focus { background: #135ba1; }
.btn-back {
  background: #fff;
  color: #2176b6;
  border: 2px solid #1976d2;
  font-weight: 600;
  border-radius: 8px;
  padding: 11px 26px;
  font-size: 1.07rem;
  transition: background .18s, color .18s, border .18s;
  display: inline-block;
  margin-top: 10px;
  margin-bottom: 6px;
}
.btn-back:hover, .btn-back:focus { background: #dbeafe; color: #1976d2; }
.venta-total {
  display: flex;
  align-items: center;
  gap: 18px;
  background: #edf6fd;
  border-radius: 9px;
  padding: 11px 19px;
  font-size: 1.13rem;
  color: #1565c0;
  margin: 22px 0 8px 0;
  box-shadow: 0 1px 8px rgba(33,150,243,0.04);
  max-width: 340px;
  align-self: flex-end;
}
.venta-total-label {
  font-weight: bold;
  font-size: 1.13rem;
  margin-right: 8px;
}
#totalVenta {
  border: none;
  background: transparent;
  font-size: 1.2rem;
  font-weight: bold;
  color: #1976d2;
  width: 92px;
  text-align: right;
  outline: none;
}
@media (max-width: 1100px) {
  .item-add-form { padding: 14px 2vw 12px 2vw; max-width: 99vw; }
  .items-table-wrap { padding-left: 2vw; padding-right: 2vw; }
  .venta-title { font-size: 1.17rem; }
  .items-table { min-width: 530px; }
}
@media (max-width: 700px) {
  .items-table th, .items-table td { font-size: 0.98rem; padding: 7px 4px; }
  .venta-total { flex-direction: column; align-items: flex-start; max-width: 97vw; }
  .btn-primary, .btn-back { width: 100%; padding: 12px 0; font-size: 1.08rem; }
  .items-table { min-width: 320px; }
  .items-table-wrap { padding: 0; }
}
</style>