<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{$_layoutParams.configs.app_name}</title>

  <!-- Bootstrap + AdminLTE + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{$_layoutParams.root}files/layouts/LTE2/dist/css/adminlte.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    :root {
      --color-primary: #0056a3;
      --color-primary-dark: #003d7a;
      --color-secondary: #f1f5f9;
      --color-accent: #d83b01;
      --color-accent-dark: #b83100;
      --color-text: #2d3748;
      --color-text-light: #4a5568;
      --color-border: #e2e8f0;
      --color-white: #ffffff;
      --color-bg-overlay: rgba(255, 255, 255, 0.96);
    }

    body {
      background-image: url('https://sau2.uqroo.mx/public/img/{$imgfondo}');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      margin: 0;
    }

    .login-container {
      background-color: var(--color-bg-overlay);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      padding: 2.5rem 3rem;
      width: 100%;
      max-width: 460px;
      border-top: 8px solid var(--color-primary);
      transform: translateY(0);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-container:hover {
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      transform: translateY(-5px);
    }

    .login-logo {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-logo h3 {
      font-weight: 700;
      font-size: 1.8rem;
      color: var(--color-primary);
      margin-bottom: 0.5rem;
      letter-spacing: -0.5px;
    }

    .subtitle {
      font-size: 1rem;
      color: var(--color-text-light);
      margin-top: 0;
      font-weight: 400;
    }

    .login-box-msg {
      text-align: center;
      font-size: 1.05rem;
      color: var(--color-text-light);
      margin-bottom: 1.5rem;
      line-height: 1.5;
    }

    .btn-office365 {
      background-color: var(--color-accent);
      color: var(--color-white);
      font-weight: 600;
      padding: 0.85rem;
      border-radius: 8px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 12px;
      margin-bottom: 1.5rem;
      text-decoration: none;
      transition: all 0.3s ease;
      border: none;
      width: 100%;
      font-size: 1rem;
    }

    .btn-office365:hover {
      background-color: var(--color-accent-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(216, 59, 1, 0.2);
    }

    .divider {
      display: flex;
      align-items: center;
      margin: 2rem 0;
      color: var(--color-text-light);
      font-size: 0.9rem;
      font-weight: 500;
    }

    .divider::before,
    .divider::after {
      content: "";
      flex: 1;
      border-bottom: 1px solid var(--color-border);
    }

    .divider::before { margin-right: 1rem; }
    .divider::after { margin-left: 1rem; }

    .toggle-login {
      text-decoration: none;
      color: var(--color-primary);
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.3s ease;
      padding: 0.5rem;
      border-radius: 6px;
      background-color: transparent;
      border: none;
      width: 100%;
    }

    .toggle-login:hover {
      background-color: rgba(0, 86, 163, 0.05);
    }

    .toggle-login i {
      transition: transform 0.3s ease;
      font-size: 0.9rem;
    }

    .toggle-login[aria-expanded="true"] i {
      transform: rotate(180deg);
    }

    .form-control {
      border-radius: 8px;
      padding: 0.75rem 1rem;
      border: 1px solid var(--color-border);
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--color-primary);
      box-shadow: 0 0 0 0.25rem rgba(0, 86, 163, 0.1);
    }

    .btn-primary {
      background-color: var(--color-primary);
      border: none;
      transition: all 0.3s ease;
      padding: 0.85rem;
      font-weight: 600;
      border-radius: 8px;
      font-size: 1rem;
    }

    .btn-primary:hover {
      background-color: var(--color-primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 86, 163, 0.2);
    }

    .alert {
      border-radius: 8px;
      padding: 0.85rem 1.25rem;
      margin-bottom: 1.5rem;
    }

    .form-label {
      font-weight: 600;
      color: var(--color-text);
      margin-bottom: 0.5rem;
    }

    .manual-login {
      background-color: rgba(241, 245, 249, 0.5);
      border-radius: 12px;
      padding: 1.5rem;
      margin-top: 1rem;
    }

    /* Animation for form */
    .collapse.show {
      animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
      .login-container {
        padding: 2rem 1.5rem;
      }
      
      .login-logo h3 {
        font-size: 1.6rem;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-logo">
      <h3>{$_layoutParams.configs.app_name}</h3>
    </div>

    <p class="login-box-msg">Bienvenido</p>

    {if isset($_error) && $_error != ''}
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>¡Atención!</strong> {$_error}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {/if}

    <!-- Office 365 Login -->
    <a href="https://sigo.uqroo.mx/usuarios/login/validaO365_2/" class="btn btn-office365">
      <i class="fas fa-building"></i>
      <span>Clic aquí para ingresar con <br>Login Oficce 365</span>
    </a>

    <div class="divider">O</div>

    <!-- Manual Login -->
    <div class="manual-login">
      <button class="toggle-login" data-bs-toggle="collapse" href="#collapseManualLogin" role="button" aria-expanded="false" aria-controls="collapseManualLogin">
        <span>Ingresar con cuenta manual</span>
        <i class="fas fa-chevron-down"></i>
      </button>

      <div class="collapse" id="collapseManualLogin">
        <form name="form1" method="post" action="" class="mt-3">
          <input type="hidden" value="1" name="enviar" />
          <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" id="username" name="usuario" class="form-control" value="{$datos.usuario|default:""}" placeholder="Ingrese su usuario" required>
          </div>
          <div class="mb-3">
            <label for="pass" class="form-label">Contraseña</label>
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Ingrese su contraseña" required>
          </div>
          <button type="submit" class="btn btn-primary w-100 mt-2">
            <i class="fas fa-sign-in-alt me-2"></i> Iniciar sesión
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Optional: Add some subtle animations -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add animation class to elements
      const loginContainer = document.querySelector('.login-container');
      setTimeout(() => {
        loginContainer.style.opacity = '1';
        loginContainer.style.transform = 'translateY(0)';
      }, 100);
      
      // Add hover effect to buttons
      const buttons = document.querySelectorAll('.btn');
      buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
          button.style.transform = 'translateY(-2px)';
        });
        button.addEventListener('mouseleave', () => {
          button.style.transform = 'translateY(0)';
        });
      });
    });
  </script>
</body>
</html>