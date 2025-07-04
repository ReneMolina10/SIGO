<?php

if (extension_loaded('oci8')) {
    echo "OCI8 está habilitado.\n";
    echo "Instant Client Version: " . oci_client_version();
} else {
    echo "OCI8 no está habilitado.";
}


phpinfo();