<?php

// Uncomment for debugging:
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

require_once 'libraries/waad-federation/ConfigurableFederatedLoginManager.php';

session_start();

// Guardar token si existe
$token = $_POST['wresult'] ?? null;

// Guardar origen en sesión
if (!empty($_GET['origen'])) {
    $_SESSION['origen'] = $_GET['origen'];
}

// Mensaje de prueba
$_SESSION['mensaje'] = 'Hola a todos';

$loginManager = new ConfigurableFederatedLoginManager();

if (!$loginManager->isAuthenticated()) {
    if (!empty($token)) {
        try {
            $loginManager->authenticate($token);

            $url = buildRedirectUrl(
                $_SESSION['servidor_origen'] ?? '',
                2,
                $loginManager->getPrincipal(),
                $_SESSION['code_login365'] ?? ''
            );
            header("Location: $url");
            exit;

        } catch (Exception $e) {
            echo "--- Token recibido ---<br>";
            echo htmlspecialchars($token) . "<br>";
            echo "Error: " . htmlspecialchars($e->getMessage());
            exit;
        }
    } else {
        // Redirigir al login de Office 365
        $loginUrl = "https://sigo.uqroo.mx/login365/login.php?returnUrl=" . urlencode("https://sigo.uqroo.mx/login365/login.php");
        header("Location: $loginUrl", true, 302);
        exit;
    }
} else {
    $principal = $loginManager->getPrincipal();

    $codeLogin = $_SESSION['code_login365'] ?? '';
    $code = encrypt($codeLogin, "universaluqr002014").'_'.$_SESSION['code_login365'];

    $url = buildRedirectUrl(
        'https://sigo.uqroo.mx/usuarios/login/ingresao365/',
        1,
        $principal,
        $code
    );
    header("Location: $url");
    exit;
}

/**
 * Construye la URL de redirección con los datos del usuario.
 */
function buildRedirectUrl($baseUrl, $logoffice, $principal, $code)
{
    $params = [
        'logoffice' => $logoffice,
        'nickname' => $principal->getCorreo(),
        'code' => $code,
        'nombre' => $principal->getNombres(),
        'apellido' => $principal->getApellidos(),
        'code2' => md5($principal->getCorreo() . $code)
    ];

    return $baseUrl . '?' . http_build_query($params);
}

/**
 * Cifra un string simple con una clave, devolviendo un hash MD5
 * NOTA: este método NO es seguro para datos sensibles.
 */
function encrypt($string, $key)
{
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }
    return md5(base64_encode($result));
}
