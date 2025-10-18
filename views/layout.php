<?php
$base = (require __DIR__ . '/../config/config.php')['app']['base_url'];
$current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$current = rtrim(str_replace(rtrim($base, '/'), '', $current), '/') ?: '/';
$isActive = function (string $path) use ($current) {
  return $current === $path ? 'active' : '';
};
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Sistema GLP</title>
  <style>
    :root {
      --bg: #f5f7fb;
      --bg-card: #ffffff;
      --txt: #1f2937;
      --txt-muted: #6b7280;
      --brand: #2563eb;
      --brand-600: #1d4ed8;
      --brand-700: #1e40af;
      --accent: #22c55e;
      --danger: #ef4444;
      --sidebar-start: #0f172a;
      --sidebar-end: #111827;
      --border: #e5e7eb;
      --ring: rgba(37, 99, 235, .35);
      --radius: 14px;
      --shadow-sm: 0 2px 8px rgba(0, 0, 0, .06);
      --shadow-md: 0 6px 24px rgba(16, 24, 40, .08);
    }

    * { box-sizing: border-box; margin: 0; padding: 0 }
    body {
      font-family: 'Segoe UI', Roboto, Arial, sans-serif;
      background: var(--bg);
      color: var(--txt);
      line-height: 1.4;
    }

    /* HEADER */
    .header {
      position: sticky; top: 0;
      background: #141e36;
      height: 64px;
      display: flex; align-items: center; gap: 10px;
      padding: 0 18px;
      box-shadow: var(--shadow-sm);
      z-index: 40;
    }
    .brand {
      color: #fff; font-weight: 700; font-size: 1.1rem;
      display: flex; align-items: center; gap: 10px;
    }
    .brand .dot { width:10px; height:10px; border-radius:50%; background: var(--accent); }
    .hamburger {
      width: 40px; height: 40px;
      display: flex; align-items: center; justify-content: center;
      border: none; background: transparent; color: #fff;
      font-size: 1.6rem; cursor: pointer; border-radius: 8px;
    }
    .hamburger:hover { background: rgba(255,255,255,0.1); }

    /* SIDEBAR */
    .sidebar {
      position: fixed; top:64px; left:0;
      width:264px; height:calc(100vh - 64px);
      background: linear-gradient(180deg,var(--sidebar-start),var(--sidebar-end));
      color:#fff; display:flex; flex-direction:column;
      overflow-y:auto; transition: transform .3s ease-in-out;
      box-shadow: var(--shadow-md);
      z-index: 50;
    }
    .sidebar-header {
      padding:18px; font-weight:700; border-bottom:1px solid rgba(255,255,255,0.1);
    }
    .sidebar nav { padding: 14px; display:flex; flex-direction:column; gap:6px; }
    .sidebar nav a {
      color:#e5e7eb; text-decoration:none; display:flex; align-items:center; gap:10px;
      padding:10px 12px; border-radius:8px; transition: all .2s;
    }
    .sidebar nav a:hover { background: rgba(255,255,255,0.1); color:#fff; }
    .sidebar nav a.active { background:#fff; color:#111827; }

    /* BACKDROP */
    .backdrop {
      position: fixed;
      inset: 64px 0 0 0;
      background: rgba(0,0,0,0.4);
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
      z-index: 45;
    }
    .backdrop.show { opacity: 1; pointer-events: auto; }

    /* CONTENT */
    .app { min-height: calc(100vh - 64px); padding-left:264px; }
    .main-wrap { display:flex; justify-content:center; padding:24px; }
    main {
      width:min(100%,1400px);
      background:#fff; border-radius:14px;
      box-shadow:var(--shadow-md);
      padding:26px; min-height:300px;
    }

    footer {
      margin:24px 22px 32px calc(264px + 22px);
      text-align:center; background:#d8dce5;
      padding:12px; border-radius:10px; color:#111;
      font-size:.9rem;
    }

    /* RESPONSIVE */
    @media(max-width:900px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.open { transform: translateX(0); }
      .app { padding-left: 0; }
      footer { margin: 24px 12px 32px 12px; }
    }
    @media(min-width:901px){ .hamburger{display:none;} }
  </style>
</head>

<body>
<header class="header">
  <button class="hamburger" id="sidebarToggle">&#9776;</button>
  <div class="brand"><span class="dot"></span> Sistema GLP - Nueva Esperanza</div>
  <div style="flex:1;"></div>

  <!-- Menú usuario -->
  <div class="user-menu">
    <button class="user-btn" onclick="toggleUserMenu()">
      <span class="user-icon">👤</span>
      <span class="user-name"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Invitado') ?></span>
      <span class="arrow">▼</span>
    </button>
    <div id="userDropdown" class="dropdown-menu">
      <a href="<?= $base ?>/profile">⚙️ Perfil</a>
      <a href="<?= $base ?>/logout" class="logout">🚪 Cerrar sesión</a>
    </div>
  </div>

  <style>
    .user-menu{position:relative;}
    .user-btn{background:transparent;border:none;color:#fff;font-weight:500;
      display:flex;align-items:center;gap:6px;cursor:pointer;padding:6px 10px;border-radius:8px;}
    .user-btn:hover{background:rgba(255,255,255,0.1);}
    .dropdown-menu{display:none;position:absolute;right:0;top:42px;background:#fff;
      border-radius:8px;min-width:160px;box-shadow:0 4px 18px rgba(0,0,0,0.12);}
    .dropdown-menu a{display:block;padding:10px 14px;text-decoration:none;color:#111;}
    .dropdown-menu a:hover{background:#f3f4f6;}
    .dropdown-menu a.logout{color:#b91c1c;}
  </style>

  <script>
    function toggleUserMenu() {
      const menu = document.getElementById('userDropdown');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }
    document.addEventListener('click', (e) => {
      const menu = document.getElementById('userDropdown');
      const btn = document.querySelector('.user-btn');
      if (!menu || !btn) return;
      if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = 'none';
      }
    });
  </script>
</header>

<div class="backdrop" id="backdrop"></div>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">Menú</div>
  <nav>
    <a class="<?= $isActive('/') ?>" href="<?= $base ?>/"><span>🏠</span>Inicio</a>
    <a class="<?= $isActive('/products') ?>" href="<?= $base ?>/products"><span>📦</span>Productos</a>
    <a class="<?= $isActive('/drivers') ?>" href="<?= $base ?>/drivers"><span>🧑‍✈️</span>Choferes</a>
    <a class="<?= $isActive('/trucks') ?>" href="<?= $base ?>/trucks"><span>🚚</span>Camiones</a>
    <a class="<?= $isActive('/routes') ?>" href="<?= $base ?>/routes"><span>🗺️</span>Rutas</a>
    <a class="<?= $isActive('/sales') ?>" href="<?= $base ?>/sales"><span>💸</span>Ventas</a>
    <a class="<?= $isActive('/schedules') ?>" href="<?= $base ?>/schedules"><span>🕒</span>Horarios</a>
    <a class="<?= $isActive('/purchases') ?>" href="<?= $base ?>/purchases"><span>🧾</span>Compras</a>
    <a class="<?= $isActive('/inventory_movements') ?>" href="<?= $base ?>/inventory_movements"><span>📊</span>Inventario</a>
  </nav>
</aside>

<div class="app">
  <div class="main-wrap">
    <main>
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
        <h1 style="font-size:1.25rem;">Panel</h1>
        <div class="muted"><?= date('d/m/Y H:i') ?></div>
      </div>
      <?= $content ?>
    </main>
  </div>
</div>

<footer><small>© <?= date('Y') ?> Nueva Esperanza</small></footer>

<script>
  const sidebar = document.getElementById('sidebar');
  const toggle = document.getElementById('sidebarToggle');
  const backdrop = document.getElementById('backdrop');

  function isMobile() { return window.innerWidth <= 900; }
  function openSidebar() { sidebar.classList.add('open'); backdrop.classList.add('show'); }
  function closeSidebar() { sidebar.classList.remove('open'); backdrop.classList.remove('show'); }

  toggle?.addEventListener('click', () => {
    if (isMobile()) {
      sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    }
  });
  backdrop.addEventListener('click', closeSidebar);
  window.addEventListener('keydown', e => { if (e.key === 'Escape' && isMobile()) closeSidebar(); });
  window.addEventListener('resize', () => { if (!isMobile()) closeSidebar(); });
</script>
</body>
</html>
