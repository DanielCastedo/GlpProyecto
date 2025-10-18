<style>
.panel-welcome {
  max-width: 650px;
  margin: 40px auto;
  background: #f9fcff;
  border-radius: 18px;
  box-shadow: 0 2px 16px rgba(33,150,243,0.07);
  padding: 38px 32px;
  text-align: center;
}
.panel-welcome .icon-gas {
  margin-bottom: 22px;
}
.panel-welcome h2 {
  font-size: 2.1rem;
  color: #1976d2;
  margin-bottom: 14px;
  font-weight: 700;
}
.panel-welcome p {
  font-size: 1.17rem;
  color: #333;
  margin-bottom: 18px;
}
.panel-welcome .quick-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 14px;
  margin-top: 22px;
}
.panel-welcome .btn {
  background: #1976d2;
  color: #fff;
  border: none;
  padding: 12px 26px;
  border-radius: 8px;
  font-size: 1.08rem;
  cursor: pointer;
  text-decoration: none;
  transition: background .18s, box-shadow .17s;
  font-weight: 500;
  box-shadow: 0 1px 8px rgba(25,118,210,0.11);
}
.panel-welcome .btn:hover, .panel-welcome .btn:focus {
  background: #135ba1;
}
</style>

<div class="panel-welcome">
  <div class="icon-gas">
    <!-- Icono SVG de garrafa/gas -->
    <svg width="82" height="82" viewBox="0 0 64 64" fill="none">
      <rect x="20" y="12" width="24" height="40" rx="8" fill="#1976d2"/>
      <rect x="24" y="24" width="16" height="20" rx="5" fill="#fff"/>
      <rect x="28" y="7" width="8" height="10" rx="3" fill="#1976d2"/>
      <rect x="30" y="2" width="4" height="6" rx="2" fill="#1976d2"/>
    </svg>
  </div>
  <h2>Bienvenido al Panel GLP</h2>
  <p>
    Este sistema te permite gestionar la <b>venta, inventario y entrega de garrafas de gas GLP</b> de manera eficiente y segura.<br>
    Accede rápidamente a los módulos principales y comienza a operar:
  </p>
  <div class="quick-actions">
    <a class="btn" href="<?= $base ?>/products">Productos</a>
    <a class="btn" href="<?= $base ?>/sales">Registrar Venta</a>
    <a class="btn" href="<?= $base ?>/drivers">Choferes</a>
    <a class="btn" href="<?= $base ?>/routes">Rutas</a>
    <a class="btn" href="<?= $base ?>/inventory">Inventario</a>
  </div>
</div>