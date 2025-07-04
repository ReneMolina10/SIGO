{* Botón para previsualizar PDF *}
{if isset($d[$f.campo]) && $d[$f.campo] != ''}
    <a href="{$BASE_URL}docminutas/exec/previsualizarPDF/{$d[$f.campo]}" target="_blank" class="btn btn-outline-danger mb-2">
        <i class="far fa-eye nav-icon"></i> Previsualizar PDF
    </a>
{/if}