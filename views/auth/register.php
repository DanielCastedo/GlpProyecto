<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Crear Cuenta - Sistema GLP</title>
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
    .login-box .login-link {
      margin-top: 14px;
      display: block;
      font-size: .95rem;
      color: #2563eb;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }
    .login-box .login-link:hover {
      color: #1e40af;
      text-decoration: underline;
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
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Crear Cuenta</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $base ?>/register">
      <div class="field">
        <label>Nombre</label>
        <input type="text" name="name" required>
      </div>

      <div class="field">
        <label>Correo electrónico</label>
        <input type="email" name="email" required>
      </div>

      <div class="field">
        <label>Contraseña</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit">Registrar</button>
    </form>

    <a href="<?= $base ?>/login" class="login-link">¿Ya tienes cuenta? Inicia sesión</a>
  </div>
</body>
</html>
