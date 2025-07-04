<style>
.textarea-elegante {
    border: 1.5px solid #bdbdbd;
    border-radius: 0rem;
    background: #f8fafc;
    transition: border-color 0.2s, box-shadow 0.2s;
    font-size: 1.05rem;
    padding: 1rem;
    min-height: 120px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    resize: vertical;
}
.textarea-elegante:focus {
    border-color: #0dcadf;
    background: #fff;
    box-shadow: 0 0 0 2px #1976d233;
    outline: none;
}
.char-counter-elegante {
    font-family: 'Segoe UI', Arial, sans-serif;
    font-size: 0.95em;
    letter-spacing: 0.5px;
}
</style>
<div class="position-relative">
    <textarea
        class="form-control textarea-elegante"
        name="{$f.campo|escape}"
        id="{$f.campo|escape}"
        placeholder="{$f.holder|default:''|escape}"
        style="{if isset($f.alto)}height:{$f.alto|escape};{/if}{if isset($f.style)}{$f.style|escape}{/if}"
        {if isset($f.required) && $f.required == "true"} required{/if}
        {if isset($f.max)} maxlength="{$f.max|escape}"{/if}
        {if isset($f.rows)} rows="{$f.rows|escape}"{elseif isset($f.row)} rows="{$f.row|escape}"{/if}
        {if isset($f.readonly) && $f.readonly == "true"} readonly{/if}
        {if isset($f.disabled) && $f.disabled == "true"} disabled{/if}
        {$detalles|default:""}
        oninput="updateCharCount_{$f.campo|escape}()"
    >{$d[$f.campo]|default:$f.value|default:''|escape}</textarea>
    <div class="text-end char-counter-elegante mt-1">
        <span id="charCount_{$f.campo|escape}">0</span>
        de
        <span id="charMax_{$f.campo|escape}">{$f.max|default:'∞'}</span>
    </div>
</div>
<script>
function updateCharCount_{$f.campo|escape}() {
    var textarea = document.getElementById('{$f.campo|escape}');
    var count = textarea.value.length;
    var max = {$f.max|default:'null'};
    var countSpan = document.getElementById('charCount_{$f.campo|escape}');
    countSpan.textContent = count;
    if (max !== null) {
        document.getElementById('charMax_{$f.campo|escape}').textContent = max;
        if (count >= max) {
            countSpan.classList.add('text-danger');
        } else {
            countSpan.classList.remove('text-danger');
        }
    }
}
// Inicializa el contador al cargar la página
document.addEventListener('DOMContentLoaded', updateCharCount_{$f.campo|escape});
</script>