<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Iniciar Sesión - Sistema GLP</title>
  <style>
    body {
      font-family: 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, #1e3a8a, #2563eb);
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      color: #333;
    }
    .login-box {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 8px 28px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
      padding: 38px 28px;
      text-align: center;
    }
    .login-box h2 {
      color: #1e3a8a;
      margin-bottom: 22px;
      font-weight: 700;
    }
    .login-box .field {
      margin-bottom: 16px;
      text-align: left;
    }
    .login-box label {
      display: block;
      font-size: .9rem;
      margin-bottom: 6px;
      color: #444;
    }
    .login-box input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      outline: none;
      transition: border-color 0.2s;
    }
    .login-box input:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
    }
    .login-box button {
      background: #2563eb;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
      margin-top: 10px;
      transition: background 0.2s;
    }
    .login-box button:hover {
      background: #1d4ed8;
    }
    .error {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
      padding: 8px 10px;
      border-radius: 8px;
      margin-bottom: 12px;
      font-size: .9rem;
    }
    footer {
      position: fixed;
      bottom: 14px;
      text-align: center;
      width: 100%;
      color: #fff;
      font-size: .9rem;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $base ?>/login">
      <div class="field">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button type="submit">Entrar</button>
    </form>
  </div>

  <footer>© <?= date('Y') ?> Nueva Esperanza - Sistema GLP</footer>
</body>
</html>
