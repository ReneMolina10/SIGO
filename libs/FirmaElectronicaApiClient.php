<?php

// URL base definitiva de las APIs
define('API_URL', 'https://apis-system.uqroo.mx:8443/efirmas-1.0');
define('API_EMAIL', 'jose.ku.salazar@uqroo.edu.mx');
define('API_PASSWORD', 'berlin88$');

class FirmaElectronicaApiClient
{
    /**
     * Autentica contra el endpoint y devuelve el JWT o null si falla.
     *
     * @return string|null
     */
    public function authenticate()
    {
        $url = API_URL . '/api/v1/auth/authenticate';
        $payload = json_encode([
            'email' => API_EMAIL,
            'password' => API_PASSWORD,
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $curlErr = curl_error($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($curlErr || $statusCode !== 200) {
            // aquí podrías loguear $curlErr o $statusCode
            return null;
        }

        $data = json_decode($response, true);
        return isset($data['data']['token']) ? $data['data']['token'] : null;
    }

    /**
     * Llama al endpoint /api/v1/auth/info usando el JWT y devuelve
     * el array con los datos o null en caso de error.
     *
     * @param  string $token  JWT obtenido en authenticate()
     * @return array|null
     */
    public function getInfo($token)
    {
        $url = API_URL . '/api/v1/auth/info';

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token,
            ],
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($err || $status !== 200) {
            // aquí podrías loguear $err o $status
            return null;
        }

        $payload = json_decode($response, true);
        // El contenido útil está en ["data"]
        return isset($payload['data']) ? $payload['data'] : null;
    }

    /**
     * Crea un nuevo documento en la API y devuelve su ID o null en caso de error.
     *
     * @param  string $token    JWT obtenido previamente
     * @param  array  $docData  Array con el JSON que requiere el endpoint
     * @return string|null      documentId o null si hubo error
     */
    public function createDocument($token, array $docData)
    {
        $url = API_URL . '/api/v1/documents';
        $payload = json_encode($docData);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token,
            ],
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // --- Depuración ---
        // echo "cURL error: {$err}\n";
        // echo "HTTP status: {$status}\n";
        // echo "Response raw: {$response}\n";
        // ------------------

        if ($err || ($status !== 200 && $status !== 201)) {
            return null;
        }

        $responseData = json_decode($response, true);

        return [
            'id' => $responseData['data']['id'] ?? null,
            'folio' => $responseData['data']['folio'] ?? null,
            'externalId' => $responseData['data']['externalId'] ?? null,
            'status' => $responseData['data']['status'] ?? null,
            'fecha_creacion' => $responseData['data']['date'] ?? null,
            'dateSign' => $responseData['data']['dateSign'] ?? null
        ];
    }

    /**
     * GET /api/v1/documents/{folio}
     *
     * @param string $token JWT válido
     * @param string $folio El folio devuelto al crear el doc
     * @return array|null   Datos del documento o null si falla
     */
    public function getDocumentByFolio($token, $folio)
    {
        $url = API_URL . '/api/v1/documents/' . $folio;
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Authorization: Bearer ' . $token,
            ],
            CURLOPT_POSTFIELDS => '{}',
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Depuración opcional:
        // echo "GET error: $err\n";
        // echo "GET HTTP status: $status\n";
        // echo "GET raw: $response\n";

        if ($err || $status !== 200) {
            return null;
        }
        $data = json_decode($response, true);
        return $data['data'] ?? null;
    }

    /**
     * Paso 5: Firmar el documento.
     *
     * @param  string $token         JWT
     * @param  array  $signPayload   Array con el JSON que espera /sign
     * @return array|null            Respuesta del servidor o null en error
     */
    /*public function signDocument($token, array $signPayload)
    {
        $url     = API_URL . '/api/v1/sign';
        $payload = json_encode($signPayload);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json',            // <— lo añadimos
                'Authorization: Bearer ' . $token,
            ],
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $err      = curl_error($ch);
        $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Depuración reforzada:
        echo "SIGN cURL error: ›{$err}‹\n";          // si hay un error de red
        echo "SIGN HTTP status: ›{$status}‹\n";      // el código devuelto
        echo "SIGN raw response: {$response}\n";     // el body bruto

        // Ahora validamos:
        if ($err) {
            echo "Falló la conexión al firmar.\n";
            return null;
        }
        if ($status !== 200 && $status !== 201) {
            echo "El servidor respondió con código {$status} al firmar.\n";
            return null;
        }

        $decoded = json_decode($response, true);
        if (! isset($decoded['data'])) {
            echo "No vino el nodo 'data' en la respuesta de firma.\n";
            return null;
        }
        return $decoded['data'];
    }*/

}
