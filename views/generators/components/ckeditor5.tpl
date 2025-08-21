</style>
{* CKEditor5.tpl *}
<div class="main-container">
  <div class="editor-container editor-container_classic-editor editor-container_include-style editor-container_include-word-count editor-container_include-fullscreen">
    <div class="editor-container__editor">
      <div class="ck5-editor" id="{$f.campo}_editor" data-field="{$f.campo}">
        {$registro[$f.campo] nofilter}
      </div>
    </div>
    <div class="editor_container__word-count" id="{$f.campo}_wc"></div>
  </div>
</div>

<input type="hidden" name="{$f.campo}" id="{$f.campo}" value="{$registro[$f.campo]|escape:'html'}" {if $f.required=='true'}required{/if}>
