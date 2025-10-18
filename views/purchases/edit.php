<h2 style="margin-bottom:22px;">Editar Compra #<?= $purchase['id'] ?></h2>

<form method="post" action="<?= $base ?>/purchases/update" class="form-grid">
  <input type="hidden" name="id" value="<?= $purchase['id'] ?>">

  <div class="field field--4">
    <label class="label">Fecha</label>
    <input type="date" name="date" class="input" value="<?= $purchase['date'] ?>">
  </div>

  <div class="field field--6">
    <label class="label">Proveedor</label>
    <input type="text" name="supplier" class="input" value="<?= htmlspecialchars($purchase['supplier']) ?>">
  </div>

  <div class="field field--6">
    <label class="label">Chofer</label>
    <select name="driver_id" class="select">
      <?php foreach ($drivers as $d): ?>
        <option value="<?= $d['id'] ?>" <?= $d['id'] == $purchase['driver_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($d['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="field field--6">
    <label class="label">Camión</label>
    <select name="truck_id" class="select">
      <?php foreach ($trucks as $t): ?>
        <option value="<?= $t['id'] ?>" <?= $t['id'] == $purchase['truck_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($t['plate']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="field field--4">
    <label class="label">Estado</label>
    <select name="status" class="select">
      <?php foreach (['draft', 'confirmed', 'cancelled'] as $s): ?>
        <option value="<?= $s ?>" <?= $s == $purchase['status'] ? 'selected' : '' ?>>
          <?= ucfirst($s) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="field field--12">
    <button class="btn btn-primary">💾 Actualizar compra</button>
  </div>
</form>

<hr style="margin:28px 0; border:none; border-top:2px solid #e0e0e0;">

<h3 style="margin-bottom:12px;">Productos de la compra</h3>

<form method="post" action="<?= $base ?>/purchase_items/store" class="form-grid" style="align-items:end;">
  <input type="hidden" name="purchase_id" value="<?= $purchase['id'] ?>">

  <div class="field field--6">
    <label class="label">Producto</label>
    <select name="product_id" class="select" required>
      <option value="">Seleccione un producto</option>
      <?php foreach ($products as $p): ?>
        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="field field--3">
    <label class="label">Cantidad</label>
    <input type="number" name="qty" class="input" placeholder="Cantidad" min="1" required>
  </div>

  <div class="field field--3">
    <label class="label">Costo Unitario</label>
    <input type="number" step="0.01" name="unit_cost" class="input" placeholder="Costo" required>
  </div>

  <div class="field field--12">
    <button class="btn btn-primary">➕ Añadir producto</button>
  </div>
</form>

<table class="sales-table" style="margin-top:14px;">
  <thead>
    <tr>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Costo Unitario</th>
      <th>Subtotal</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $it): ?>
      <tr>
        <td><?= htmlspecialchars($it['product_name']) ?></td>
        <td><?= $it['qty'] ?></td>
        <td><?= number_format($it['unit_cost'], 2) ?></td>
        <td><?= number_format($it['subtotal'], 2) ?></td>
        <td>
          <form method="post" action="<?= $base ?>/purchase_items/destroy" onsubmit="return confirm('¿Eliminar producto de la compra?')">
            <input type="hidden" name="id" value="<?= $it['id'] ?>">
            <input type="hidden" name="purchase_id" value="<?= $purchase['id'] ?>">
            <button class="btn btn-danger btn-action" title="Eliminar">✖</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<p style="margin-top:14px; font-size:1.05rem;">
  <strong>Total: </strong> Bs <?= number_format($purchase['total'], 2) ?>
</p>

<form method="post" action="<?= $base ?>/purchases/confirm" style="margin-top:16px;">
  <input type="hidden" name="id" value="<?= $purchase['id'] ?>">
  <button class="btn btn-secondary">✅ Confirmar compra y actualizar inventario</button>
</form>

<style>
  .form-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 14px;
    margin-bottom: 20px;
  }

  .field {
    grid-column: span 12;
  }

  .field--3 { grid-column: span 3; }
  .field--4 { grid-column: span 4; }
  .field--6 { grid-column: span 6; }
  .field--12 { grid-column: span 12; }

  .label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
  }

  .input, .select {
    width: 100%;
    border: 1px solid #d0d7de;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: .97rem;
    transition: border-color .15s ease;
  }

  .input:focus, .select:focus {
    border-color: #1976d2;
    outline: none;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.15);
  }

  .btn {
    background: #1976d2;
    color: #fff;
    border: none;
    padding: 8px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    font-size: .97rem;
    transition: background .18s;
  }

  .btn:hover { background: #135ba1; }

  .btn-danger {
    background: #e53935 !important;
  }
  .btn-danger:hover {
    background: #b71c1c !important;
  }

  .btn-secondary {
    background: #2196f3;
  }
  .btn-secondary:hover {
    background: #176cb8;
  }

  .sales-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(25, 118, 210, 0.08);
    overflow: hidden;
  }

  .sales-table thead {
    background: #1976d2;
    color: #fff;
  }

  .sales-table th, .sales-table td {
    padding: 12px 14px;
    border-bottom: 1px solid #e8eef5;
  }

  .sales-table tbody tr:hover td {
    background: #f8fbff;
  }

  @media (max-width: 700px) {
    .form-grid {
      grid-template-columns: 1fr;
    }

    .sales-table, .sales-table thead, .sales-table tbody, .sales-table tr, .sales-table td {
      display: block;
      width: 100%;
    }

    .sales-table thead { display: none; }

    .sales-table tr {
      margin-bottom: 12px;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 10px;
    }
  }
</style>
