<?php $base = (require __DIR__ . '/../config/config.php')['app']['base_url']; ?>
<!doctype html><html lang="es"><head>
<meta charset="utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Sistema GLP</title>
<link rel="stylesheet" href="<?= $base ?>/assets/css/styles.css">
</head><body>
<header>
  <h1>Sistema GLP - Nueva Esperanza</h1>
  <nav>
    <a href="<?= $base ?>/">Inicio</a>
    <a href="<?= $base ?>/products">Productos</a>
    <a href="<?= $base ?>/drivers">Choferes</a>
    <a href="<?= $base ?>/trucks">Camiones</a>
    <a href="<?= $base ?>/routes">Rutas</a>
  </nav>
</header>
<main><?= $content ?></main>
<footer><small>© <?= date('Y') ?> Nueva Esperanza</small></footer>
</body></html>
