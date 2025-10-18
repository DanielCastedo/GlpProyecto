<?php
$base = (require __DIR__ . '/../config/config.php')['app']['base_url'];
// Ruta actual relativa a $base (sirve para "activo" en el menú)
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
    /* =========================
   Variables & Reset
========================= */
    :root {
      --bg: #f5f7fb;
      --bg-card: #ffffff;
      --txt: #1f2937;
      --txt-muted: #6b7280;
      --brand: #2563eb;
      /* azul */
      --brand-600: #1d4ed8;
      --brand-700: #1e40af;
      --accent: #22c55e;
      /* verde */
      --danger: #ef4444;
      /* rojo */
      --warning: #f59e0b;
      /* ámbar */
      --sidebar-start: #0f172a;
      /* degradado sidebar */
      --sidebar-end: #111827;
      --border: #e5e7eb;
      --ring: rgba(37, 99, 235, .35);

      --radius: 14px;
      --radius-sm: 10px;
      --space-1: 6px;
      --space-2: 10px;
      --space-3: 14px;
      --space-4: 18px;
      --space-5: 24px;
      --shadow-sm: 0 2px 8px rgba(0, 0, 0, .06);
      --shadow-md: 0 6px 24px rgba(16, 24, 40, .08);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    html,
    body {
      height: 100%
    }

    body {
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, "Noto Sans", "Helvetica Neue", sans-serif;
      background: var(--bg);
      color: var(--txt);
      line-height: 1.4;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* =========================
   Header
========================= */
    .header {
      position: sticky;
      top: 0;
      background: #141e36ff;
      height: 64px;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 0 var(--space-4);
      box-shadow: var(--shadow-sm);
      z-index: 40;
      /* por encima del backdrop */
    }

    .header .brand {
      color: #fff;
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 700;
      font-size: 1.1rem;
      letter-spacing: .3px;
    }

    .header .brand .dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--accent);
    }

    .hamburger {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: none;
      background: transparent;
      font-size: 1.6rem;
      cursor: pointer;
      color: var(--brand-700);
      border-radius: 10px;
    }

    .hamburger:hover {
      background: #eef2ff;
    }

    .hamburger:focus-visible {
      outline: 2px solid var(--ring);
      outline-offset: 2px;
    }

    /* =========================
   Sidebar fija
========================= */
    .sidebar {
      position: fixed;
      top: 64px;
      /* altura del header */
      left: 0;
      height: calc(100dvh - 64px);
      width: 264px;
      background: linear-gradient(180deg, var(--sidebar-start), var(--sidebar-end));
      color: #fff;
      border-right: 1px solid rgba(255, 255, 255, .06);
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      /* scroll interno si el menú es largo */
      transition: transform .28s ease;
      transform: translateX(0);
      /* visible por defecto en desktop */
      box-shadow: var(--shadow-md);
      z-index: 50;
    }

    .sidebar-header {
      padding: var(--space-5);
      font-size: 1.1rem;
      font-weight: 700;
      letter-spacing: .5px;
      border-bottom: 1px solid rgba(255, 255, 255, .07);
      opacity: .95;
    }

    .sidebar nav {
      padding: var(--space-4);
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .sidebar nav a {
      --bg-item: rgba(255, 255, 255, .06);
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: #e5e7eb;
      padding: 10px 12px;
      border-radius: 10px;
      transition: background .18s ease, color .18s ease, transform .1s ease;
      font-weight: 500;
    }

    .sidebar nav a:hover {
      background: var(--bg-item);
      color: #fff;
      transform: translateX(1px);
    }

    .sidebar nav a.active {
      background: #fff;
      color: #111827;
    }

    .sidebar nav a .icon {
      width: 22px;
      text-align: center;
    }

    /* Backdrop móvil */
    .backdrop {
      position: fixed;
      inset: 64px 0 0 0;
      /* debajo del header */
      background: rgba(2, 6, 23, .42);
      opacity: 0;
      pointer-events: none;
      transition: opacity .2s ease;
      z-index: 45;
    }

    .backdrop.show {
      opacity: 1;
      pointer-events: auto;
    }

    /* =========================
   Contenido principal
========================= */
    .app {
      min-height: calc(100dvh - 64px);
      display: block;
      padding-left: 264px;
      /* deja espacio para la sidebar fija en desktop */
    }

    .main-wrap {
      display: flex;
      justify-content: center;
      padding: 28px 22px;
    }

    main {
      width: min(100%, 1040px);
      background: var(--bg-card);
      border-radius: var(--radius);
      box-shadow: var(--shadow-md);
      padding: 26px 22px 28px;
      min-height: 320px;
    }

    /* =========================
   Footer
========================= */
    footer {
      /* alineado con el contenido cuando hay sidebar fija */
      margin: 24px 22px 32px calc(264px + 22px);
      text-align: center;
      font-size: .95rem;
      color: #fff;
      background: #d8dce5ff;
      padding: 14px 16px;
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
    }

    /* =========================
   Componentes
========================= */
    .btn {
      appearance: none;
      border: none;
      cursor: pointer;
      border-radius: 12px;
      padding: 10px 14px;
      font-weight: 600;
      transition: transform .08s ease, box-shadow .2s ease, background .2s ease;
    }

    .btn:active {
      transform: translateY(1px);
    }

    .btn:focus-visible {
      outline: 2px solid var(--ring);
      outline-offset: 2px;
    }

    .btn-primary {
      background: var(--brand);
      color: #fff;
    }

    .btn-primary:hover {
      background: var(--brand-600);
    }

    .btn-ghost {
      background: #eef2ff;
      color: var(--brand-700);
    }

    .btn-ghost:hover {
      background: #e0e7ff;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: .78rem;
      padding: 4px 8px;
      border-radius: 999px;
      background: #eef2ff;
      color: var(--brand-700);
    }

    .badge.success {
      background: #ecfdf5;
      color: #065f46;
    }

    .badge.warn {
      background: #fffbeb;
      color: #92400e;
    }

    .badge.danger {
      background: #fef2f2;
      color: #991b1b;
    }

    .table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      margin-top: 6px;
      font-size: .95rem;
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
    }

    .table thead th {
      background: #f8fafc;
      text-align: left;
      font-weight: 700;
      color: #334155;
      padding: 12px 12px;
      border-bottom: 1px solid var(--border);
    }

    .table tbody td {
      padding: 12px 12px;
      border-bottom: 1px solid var(--border);
      color: #374151;
    }

    .table tbody tr:hover {
      background: #f9fafb;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      gap: 14px;
    }

    .field {
      grid-column: span 12;
    }

    @media(min-width:700px) {
      .field--6 {
        grid-column: span 6;
      }

      .field--4 {
        grid-column: span 4;
      }
    }

    .label {
      display: block;
      font-size: .9rem;
      color: #374151;
      margin-bottom: 6px;
    }

    .input,
    .select,
    .textarea {
      width: 100%;
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 10px 12px;
      font-size: .97rem;
      background: #fff;
      transition: border-color .15s ease, box-shadow .2s ease;
    }

    .input:focus,
    .select:focus,
    .textarea:focus {
      outline: none;
      border-color: var(--brand-600);
      box-shadow: 0 0 0 4px var(--ring);
    }

    .textarea {
      min-height: 120px;
      resize: vertical;
    }

    .alert {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      border-radius: 12px;
      padding: 12px 14px;
      margin: 8px 0 12px;
      border: 1px solid;
    }

    .alert.info {
      background: #eff6ff;
      color: #1e3a8a;
      border-color: #bfdbfe;
    }

    .alert.success {
      background: #ecfdf5;
      color: #065f46;
      border-color: #a7f3d0;
    }

    .alert.warn {
      background: #fffbeb;
      color: #92400e;
      border-color: #fde68a;
    }

    .alert.danger {
      background: #fef2f2;
      color: #991b1b;
      border-color: #fecaca;
    }

    .muted {
      color: var(--txt-muted);
    }

    .spacer {
      height: 10px;
    }

    .card {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 14px;
      box-shadow: var(--shadow-sm);
    }

    /* =========================
   Responsive
========================= */
    @media (max-width: 900px) {

      /* Sidebar se oculta fuera de pantalla en móvil */
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.open {
        transform: translateX(0);
      }

      /* El contenido ocupa todo el ancho cuando la sidebar está oculta */
      .app {
        padding-left: 0;
      }

      .main-wrap {
        padding: 18px 12px;
      }

      main {
        padding: 18px 14px;
        border-radius: 12px;
      }

      /* Footer a ancho completo en móvil */
      footer {
        margin: 24px 12px 32px 12px;
      }
    }

    @media (min-width: 901px) {
      .hamburger {
        display: none;
      }
    }
  </style>
</head>

<body>
    <header class="header">
    <button class="hamburger" id="sidebarToggle" aria-label="Abrir menú">&#9776;</button>
    <div class="brand"><span class="dot"></span> Sistema GLP - Nueva Esperanza</div>

    <!-- Contenedor flexible para empujar el perfil a la derecha -->
    <div style="flex:1;"></div>

    <!-- Menú de usuario -->
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
      .user-menu {
        position: relative;
      }
      .user-btn {
        background: transparent;
        border: none;
        color: #fff;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        padding: 6px 10px;
        border-radius: 8px;
        transition: background 0.2s;
      }
      .user-btn:hover {
        background: rgba(255,255,255,0.1);
      }
      .user-icon {
        font-size: 1.2rem;
      }
      .arrow {
        font-size: .8rem;
        opacity: 0.8;
      }
      .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 42px;
        background: #fff;
        border-radius: 10px;
        min-width: 160px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.12);
        overflow: hidden;
        z-index: 100;
      }
      .dropdown-menu a {
        display: block;
        padding: 10px 14px;
        text-decoration: none;
        color: #111;
        font-size: .95rem;
        transition: background .15s;
      }
      .dropdown-menu a:hover {
        background: #f3f4f6;
      }
      .dropdown-menu a.logout {
        color: #b91c1c;
      }
    </style>

    <script>
      function toggleUserMenu() {
        const menu = document.getElementById('userDropdown');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
      }

      // Cierra el menú si se hace clic fuera
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

  <!-- Backdrop para móvil -->
  <div class="backdrop" id="backdrop"></div>

  <aside class="sidebar" id="sidebar" aria-label="Menú principal">
    <div class="sidebar-header">Menú</div>
    <nav>
      <a class="<?= $isActive('/') ?>" href="<?= $base ?>/"><span class="icon">🏠</span>Inicio</a>
      <a class="<?= $isActive('/products') ?>" href="<?= $base ?>/products"><span class="icon">📦</span>Productos</a>
      <a class="<?= $isActive('/drivers') ?>" href="<?= $base ?>/drivers"><span class="icon">🧑‍✈️</span>Choferes</a>
      <a class="<?= $isActive('/trucks') ?>" href="<?= $base ?>/trucks"><span class="icon">🚚</span>Camiones</a>
      <a class="<?= $isActive('/routes') ?>" href="<?= $base ?>/routes"><span class="icon">🗺️</span>Rutas</a>
      <a class="<?= $isActive('/sales') ?>" href="<?= $base ?>/sales"><span class="icon">💸</span>Ventas</a>
      <a class="<?= $isActive('/schedules') ?>" href="<?= $base ?>/schedules">
        <span class="icon">🕒</span>Horarios
      </a>

      <a class="<?= $isActive('/purchases') ?>" href="<?= $base ?>/purchases">
        <span class="icon">🧾</span>Compras
      </a>


      <a class="<?= $isActive('/inventory_movements') ?>" href="<?= $base ?>/inventory_movements">
        <span class="icon" style="vertical-align:middle;">
          <!-- Icono SVG garrafa/inventario -->
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <rect x="7" y="4" width="10" height="16" rx="5" fill="#1976d2" />
            <rect x="9" y="9" width="6" height="7" rx="3" fill="#fff" />
            <rect x="10" y="2" width="4" height="3" rx="1.5" fill="#1976d2" />
          </svg>
        </span>
        Inventario
      </a>
    </nav>
  </aside>

  <div class="app">
    <div class="main-wrap">
      <main>
        <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:10px;">
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
    function isMobile() {
      return window.innerWidth <= 900;
    }

    function openSidebar() {
      sidebar.classList.add('open');
      backdrop.classList.add('show');
    }
    function closeSidebar() {
      sidebar.classList.remove('open');
      backdrop.classList.remove('show');
    }

    toggle?.addEventListener('click', () => {
      if (isMobile()) {
        if (sidebar.classList.contains('open')) closeSidebar();
        else openSidebar();
      }
    });

    // Cerrar al clicar fuera en móvil
    backdrop.addEventListener('click', closeSidebar);

    // Cerrar con ESC en móvil
    window.addEventListener('keydown', e => {
      if (e.key === 'Escape' && isMobile()) closeSidebar();
    });


    function closeSidebar() {
      sidebar.classList.remove('open');
      backdrop.classList.remove('show');
    }

    toggle?.addEventListener('click', () => {
      if (isMobile()) {
        if (sidebar.classList.contains('open')) closeSidebar();
        else openSidebar();
      }
    });

    // Cerrar al clicar fuera en móvil
    backdrop.addEventListener('click', closeSidebar);

    // Cerrar con ESC en móvil
    window.addEventListener('keydown', e => {
      if (e.key === 'Escape' && isMobile()) closeSidebar();
    });

    // Si se cambia el tamaño de ventana, asegura estado correcto
    window.addEventListener('resize', () => {
      if (!isMobile()) {
        // En desktop: visible y sin backdrop
        sidebar.classList.remove('open');
        backdrop.classList.remove('show');
      }
    });
  </script>
</body>

</html>