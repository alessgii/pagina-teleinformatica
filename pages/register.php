<?php
require_once(__DIR__ . '/../config/conn.php');

$error = '';
$errors = [];

if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'index.php?page=inicio');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($name === '') {
        $errors['name'] = 'Escribe tu nombre completo.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Introduce un correo electrónico válido.';
    }
    if (strlen($password) < 6) {
        $errors['password'] = 'La contraseña debe tener al menos 6 caracteres.';
    }
    if ($password !== $password2) {
        $errors['password2'] = 'Las contraseñas no coinciden.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            $errors['email'] = 'Ya existe una cuenta con ese correo.';
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :hash, "student")');
            $stmt->execute([
                ':name'  => $name,
                ':email' => $email,
                ':hash'  => password_hash($password, PASSWORD_DEFAULT),
            ]);
            header('Location: ' . BASE_URL . 'index.php?page=login&registered=1');
            exit;
        }
    }

    $error = !empty($errors) ? implode(' ', $errors) : '';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro | Teleinformática</title>

  <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>public/img/INTEL.png">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/global.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/register.css">
</head>

<body class="register-page">
  <div class="bg__glow bg__glow--green" aria-hidden="true"></div>
  <div class="bg__glow bg__glow--cyan" aria-hidden="true"></div>

  <main class="register-card">
    <div class="register-card__header">
      <img src="<?php echo BASE_URL; ?>public/img/login/intel-logo.webp" alt="Logo INTEL" class="register-card__logo">
      <h1 class="register-card__title">Crear tu cuenta</h1>
      <p class="register-card__subtitle">
        Crea tu cuenta para participar en el foro y consultar el portal de la carrera.
      </p>
    </div>

    <form class="register-form" method="POST" novalidate>
      <div class="register-field">
        <label for="name" class="register-label">Nombre completo</label>
        <input type="text" id="name" name="name" placeholder="Ej. Juan Pérez" class="register-input<?php echo isset($errors['name']) ? ' register-input--error' : ''; ?>" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" autocomplete="name" required>
      </div>

      <div class="register-field">
        <label for="email" class="register-label">Correo Electrónico</label>
        <div class="register-input-wrap">
          <input type="email" id="email" name="email" placeholder="tu@correo.com" class="register-input register-input--icon<?php echo isset($errors['email']) ? ' register-input--error' : ''; ?>" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" autocomplete="email" required>
          <span class="register-input-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="M3 7l9 6 9-6" />
            </svg>
          </span>
        </div>
      </div>

      <div class="register-field">
        <label for="password" class="register-label">Contraseña</label>
        <div class="register-input-wrap">
          <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" class="register-input<?php echo isset($errors['password']) ? ' register-input--error' : ''; ?>" autocomplete="new-password" required>
          <button type="button" class="register-toggle-password" data-target="password" aria-label="Mostrar contraseña">
            <span class="icon-eye">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M21 12c-2.4 4-5.4 6-9 6c-3.6 0-6.6-2-9-6c2.4-4 5.4-6 9-6c3.6 0 6.6 2 9 6" />
              </svg>
            </span>
            <span class="icon-eye-off" hidden>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8" />
                <path d="M9.4 5.7A8.7 8.7 0 0 1 12 5c3.6 0 6.6 2 9 6a14.4 14.4 0 0 1-2.6 3.3" />
                <path d="M6.6 6.6A13.6 13.6 0 0 0 3 12c2.4 4 5.4 6 9 6a8.7 8.7 0 0 0 4.3-1.1" />
                <path d="M3 3l18 18" />
              </svg>
            </span>
          </button>
        </div>
      </div>

      <div class="register-field">
        <label for="password2" class="register-label">Confirmar contraseña</label>
        <input type="password" id="password2" name="password2" placeholder="Repite tu contraseña" class="register-input<?php echo isset($errors['password2']) ? ' register-input--error' : ''; ?>" autocomplete="new-password" required>
      </div>

      <?php if ($error): ?>
        <div class="register-error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <button type="submit" class="register-submit" id="submitBtn">
        <span id="submitLabel">Crear cuenta</span>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M5 12l14 0" />
          <path d="M13 6l6 6l-6 6" />
        </svg>
      </button>

      <p class="register-footer">
        ¿Ya tienes cuenta?
        <a href="<?php echo BASE_URL; ?>index.php?page=login" class="register-link">Inicia sesión</a>
      </p>
    </form>
  </main>

  <script>
    const submitBtn = document.getElementById('submitBtn');
    const submitLabel = document.getElementById('submitLabel');

    document.querySelectorAll('.register-toggle-password').forEach((btn) => {
      btn.addEventListener('click', () => {
        const input = document.getElementById(btn.dataset.target);
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.querySelector('.icon-eye').hidden = show;
        btn.querySelector('.icon-eye-off').hidden = !show;
      });
    });

    document.querySelector('.register-form').addEventListener('submit', () => {
      submitBtn.disabled = true;
      submitLabel.textContent = 'Creando cuenta...';
    });
  </script>
</body>

</html>