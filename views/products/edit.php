<a href="<?= $base ?>/products" class="btn btn-back" style="margin-bottom:18px;">
  ← Volver
</a>

<h2 style="margin-bottom:24px;">Editar producto</h2>

<form method="post" action="<?= $base ?>/products/update" class="product-edit-form">
  <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">

  <div class="product-edit-grid">
    <label>
      <span>Nombre</span>
      <input name="name" value="<?= htmlspecialchars($item['name'] ?? '') ?>" required placeholder="Ej: Garrafa 10kg">
    </label>
    <label>
      <span>SKU</span>
      <input name="sku" value="<?= htmlspecialchars($item['sku'] ?? '') ?>" required placeholder="Ej: GLP10">
    </label>
    <label>
      <span>Peso cilindro (kg)</span>
      <input name="cylinder_weight_kg" value="<?= htmlspecialchars($item['cylinder_weight_kg'] ?? '') ?>" required type="number" step="0.01" min="0" placeholder="Ej: 10">
    </label>
    <label>
      <span>Precio</span>
      <input name="price" value="<?= htmlspecialchars($item['price'] ?? '') ?>" required type="number" step="0.01" min="0" placeholder="Ej: 150.00">
    </label>
  </div>

  <button class="btn btn-primary" type="submit">Actualizar</button>
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
.product-edit-form {
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
.product-edit-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.product-edit-form label {
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
.product-edit-form input {
  margin-top: 2px;
  padding: 8px 12px;
  border-radius: 7px;
  border: 1px solid #d0d7de;
  font-size: 1.03rem;
  background: #f9fcff;
  transition: border-color .18s;
}
.product-edit-form input:focus {
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
  .product-edit-form {
    padding: 15px 2vw 14px 2vw;
    max-width: 97vw;
  }
  .product-edit-grid {
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