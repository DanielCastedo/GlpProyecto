<h2 style="margin-bottom:22px;">🧍 Editar Perfil</h2>

<form method="post" action="<?= $base ?>/profile/update" class="profile-form">
  <div class="form-grid">
    <div class="field field--6">
      <label class="label">Nombre</label>
      <input type="text" name="name" class="input" value="<?= htmlspecialchars($user['name']) ?>" required>
    </div>

    <div class="field field--6">
      <label class="label">Correo electrónico</label>
      <input type="email" name="email" class="input" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>

    <div class="field field--12">
      <label class="label">Nueva contraseña <span class="muted">(opcional)</span></label>
      <input type="password" name="password" class="input" placeholder="********">
    </div>
  </div>

  <div style="margin-top:22px;">
    <button type="submit" class="btn">💾 Actualizar Perfil</button>
    <a href="<?= $base ?>/" class="btn btn-ghost">↩️ Volver</a>
  </div>
</form>

<style>
  .profile-form {
    background: #fff;
    border-radius: 14px;
    padding: 28px 22px;
    box-shadow: 0 2px 16px rgba(33, 150, 243, 0.08);
    margin-top: 10px;
    max-width: 650px;
  }

  .form-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 16px;
  }

  .field {
    grid-column: span 12;
  }

  .field--6 {
    grid-column: span 12;
  }

  .field--12 {
    grid-column: span 12;
  }

  @media(min-width: 700px) {
    .field--6 { grid-column: span 6; }
    .field--12 { grid-column: span 12; }
  }

  .label {
    display: block;
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 6px;
    color: #374151;
  }

  .muted {
    color: #6b7280;
    font-weight: 400;
    font-size: 0.9rem;
  }

  .input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #d0d7de;
    font-size: 1rem;
    transition: border-color 0.17s ease, box-shadow 0.17s ease;
  }

  .input:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 4px rgba(25, 118, 210, 0.15);
    outline: none;
  }

  .btn {
    background: #1976d2;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .18s, box-shadow .17s;
    text-decoration: none;
    display: inline-block;
  }

  .btn:hover,
  .btn:focus {
    background: #135ba1;
    box-shadow: 0 2px 10px rgba(25, 118, 210, 0.12);
  }

  .btn-ghost {
    background: #e9eef9;
    color: #1e3a8a;
    margin-left: 6px;
  }

  .btn-ghost:hover {
    background: #cbd5e1;
  }
</style>
