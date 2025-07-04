<?php

class Hash
{
    /**
     * Genera un hash utilizando un algoritmo específico y una clave secreta.
     * 
     * @param string $algoritmo El nombre del algoritmo a usar (ejemplo: 'sha256').
     * @param string $data Los datos que serán hasheados.
     * @param string $key La clave secreta para el HMAC.
     * 
     * @return string El hash generado.
     * 
     * @throws InvalidArgumentException Si el algoritmo no es válido o no está soportado.
     */
    public static function getHash($algoritmo, $data, $key)
    {
        // Validar si el algoritmo proporcionado está soportado
        if (!in_array($algoritmo, hash_algos())) {
            throw new InvalidArgumentException("Algoritmo no soportado: $algoritmo");
        }

        // Inicializar el hash HMAC con el algoritmo y la clave proporcionados
        $hash = hash_init($algoritmo, HASH_HMAC, $key);

        // Actualizar el hash con los datos proporcionados
        hash_update($hash, $data);

        // Finalizar el hash y retornar el resultado
        return hash_final($hash);
    }
}

?>
