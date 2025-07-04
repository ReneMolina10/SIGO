<?php
$responseText = "";
$errorText = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
    $prompt = trim($_POST['prompt']);
    $api_key = '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';
    $url = 'https://api.openai.com/v1/chat/completions';

    try {
        if (!function_exists('curl_init') || !function_exists('curl_exec')) {
            throw new Exception("❌ Error: cURL no está habilitado en este servidor.");
        }

        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => "Eres un asistente útil."],
                ["role" => "user", "content" => $prompt]
            ]
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception("❌ Error en cURL: " . curl_error($ch));
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $responseData = json_decode($response, true);
        if ($http_code !== 200) {
            $errorMsg = $responseData['error']['message'] ?? 'Error desconocido';
            throw new Exception("❌ Error HTTP $http_code: $errorMsg");
        }

        $responseText = $responseData['choices'][0]['message']['content'] ?? '(Respuesta vacía)';
    } catch (Exception $e) {
        $errorText = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat con OpenAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Chat con OpenAI (GPT-3.5)</h4>
                </div>
                <div class="card-body">

                    <form method="post" novalidate>
                        <div class="mb-3">
                            <label for="prompt" class="form-label">Escribe tu mensaje:</label>
                            <textarea class="form-control" id="prompt" name="prompt" rows="5" required><?php echo htmlspecialchars($_POST['prompt'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>

                    <?php if ($responseText): ?>
                        <div class="alert alert-success mt-4" role="alert">
                            <h5 class="alert-heading">Respuesta del modelo:</h5>
                            <p class="mb-0"><?php echo nl2br(htmlspecialchars($responseText)); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($errorText): ?>
                        <div class="alert alert-danger mt-4" role="alert">
                            <h5 class="alert-heading">Error</h5>
                            <p class="mb-0"><?php echo htmlspecialchars($errorText); ?></p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS (opcional para componentes interactivos) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
