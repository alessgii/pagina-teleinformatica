<?php
require_once(__DIR__ . '/../config/conn.php');

$error = '';
$invalidEmail = false;
$invalidCredentials = false;
$registered = isset($_GET['registered']);

if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'index.php?page=inicio');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalidEmail = true;
        $error = 'Introduce un correo electrónico válido.';
    } elseif ($password === '') {
        $error = 'Introduce tu contraseña.';
    } else {
        $stmt = $pdo->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id'    => (int) $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
                'role'  => $user['role'],
            ];
            header('Location: ' . BASE_URL . 'index.php?page=inicio');
            exit;
        }

        $invalidCredentials = true;
        $error = 'Correo o contraseña incorrectos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión | Teleinformática</title>

  <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>public/img/INTEL.png">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/global.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/login.css">
</head>

<body class="login-page">
  <div class="bg__glow bg__glow--green" aria-hidden="true"></div>
  <div class="bg__glow bg__glow--cyan" aria-hidden="true"></div>

  <main class="login-page__content">
    <section class="login-page__overview">
      <img src="<?php echo BASE_URL; ?>public/img/login/intel-logo.webp" alt="Logo INTEL" class="login-page__logo">
      <div class="login-page__title-group">
        <h1 class="login-page__title-green">Ingeniería en Teleinformática</h1>
        <h2 class="login-page__subtitle">
          Portal de estudiantes de la carrera. Universidad de Guadalajara · CUCSur · Autlán de Navarro.
        </h2>
      </div>
    </section>

    <section class="login-page__form-section">
      <div class="login-page__header">
        <div class="login-page__icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
          </svg>
        </div>
        <h1 class="login-page__title">Iniciar Sesión</h1>
        <p class="login-page__description">
          Inicia sesión para participar en el foro, consultar tu horario y seguir las noticias de la carrera.
        </p>
      </div>

      <?php if ($registered): ?>
        <div class="login-page__success-banner">¡Cuenta creada! Ya puedes iniciar sesión.</div>
      <?php endif; ?>

      <form class="login-page__form" method="POST" novalidate>
        <div class="login-page__field">
          <label for="email" class="login-page__label">Correo Electrónico</label>
          <div class="login-page__input-wrap">
            <input type="email" id="email" name="email" placeholder="tu@correo.com" class="login-page__input<?php echo $invalidEmail ? ' login-page__input--error' : ''; ?>" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" autocomplete="email" required>
            <span class="login-page__input-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="5" width="18" height="14" rx="2" />
                <path d="M3 7l9 6 9-6" />
              </svg>
            </span>
          </div>
        </div>

        <div class="login-page__field">
          <label for="password" class="login-page__label">Contraseña</label>
          <div class="login-page__input-wrap">
            <input type="password" id="password" name="password" placeholder="••••••••" class="login-page__input<?php echo $invalidCredentials ? ' login-page__input--error' : ''; ?>" autocomplete="current-password" required>
            <button type="button" class="login-page__toggle-password" id="togglePassword" aria-label="Mostrar contraseña">
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

        <?php if ($error): ?>
          <div class="login-page__error-banner"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="login-page__actions">
          <label class="login-page__remember-me">
            <input type="checkbox" name="rememberMe" id="rememberMe" class="login-page__checkbox">
            Recordarme
          </label>
          <a href="#" class="login-page__link">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="login-page__submit" id="submitBtn">
          <span id="submitLabel">Entrar</span>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 12l14 0" />
            <path d="M13 6l6 6l-6 6" />
          </svg>
        </button>

        <p class="login-page__footer">
          ¿No tienes cuenta?
          <a href="<?php echo BASE_URL; ?>index.php?page=register" class="login-page__link login-page__link--bold">Regístrate aquí</a>
        </p>
      </form>
    </section>
  </main>

  <script>
    const emailInput = document.getElementById('email');
    const rememberMe = document.getElementById('rememberMe');
    const togglePassword = document.getElementById('togglePassword');
    const submitBtn = document.getElementById('submitBtn');
    const submitLabel = document.getElementById('submitLabel');

    const savedEmail = localStorage.getItem('rememberedEmail');
    if (savedEmail) {
      emailInput.value = savedEmail;
      rememberMe.checked = true;
    }

    togglePassword.addEventListener('click', () => {
      const show = document.getElementById('password').type === 'password';
      document.getElementById('password').type = show ? 'text' : 'password';
      togglePassword.querySelector('.icon-eye').hidden = show;
      togglePassword.querySelector('.icon-eye-off').hidden = !show;
    });

    document.querySelector('.login-page__form').addEventListener('submit', () => {
      if (rememberMe.checked) {
        localStorage.setItem('rememberedEmail', emailInput.value);
      } else {
        localStorage.removeItem('rememberedEmail');
      }
      submitBtn.disabled = true;
      submitLabel.textContent = 'Cargando...';
    });
  </script>
</body>

</html>
