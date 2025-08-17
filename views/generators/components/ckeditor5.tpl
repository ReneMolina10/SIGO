{* CKEditor5 componente *}
{assign var=editorId value=$id|default:("ed_"|cat:$name|cat:uniqid())}
<div class="form-group ckeditor5-wrapper mb-2">
    {if isset($label) && $label != ''}<label for="{$editorId}" class="form-label">{$label}{if $required == 'true'} *{/if}</label>{/if}
    <textarea
        id="{$editorId}"
        name="{$name}"
        class="form-control ckeditor5-textarea"
        style="width:100%; {if isset($alto) && $alto!=''}min-height:{$alto};{/if}"
        {if $required == 'true'}required{/if}
        placeholder="{$placeholder|default:$prompt|default:''}"
    >{$value|default:'' nofilter}</textarea>
</div>

{literal}
<script>
(function() {

    if (typeof window.base_url === 'undefined') {
        // Intenta derivar base_url si no está definida
        const loc = window.location;
        window.base_url = loc.origin + '/' ;
    }

    function enqueueEditor(el) {
        window.__CKE5_CREATE({
            el,
            config: {
                language: 'es',
                placeholder: el.getAttribute('placeholder') || 'Escriba el contenido...',
                toolbar: {
                    items: [
                        'undo','redo','|',
                        'bold','italic','underline','strikethrough','removeFormat','|',
                        'bulletedList','numberedList','outdent','indent','|',
                        'alignment','blockQuote','|',
                        'link','insertTable','|',
                        'fontSize','fontColor','fontBackgroundColor'
                    ],
                    shouldNotGroupWhenFull: true
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            }
        });
    }

    if (!window.__CKE5_ASSETS_LOADED) {
        window.__CKE5_ASSETS_LOADED = true;

        const cssFiles = [
            base_url + 'ckeditorGPLlicense/ckeditor5-builder-46.0.0/ckeditor5/ckeditor5.css'
        ];
        cssFiles.forEach(href => {
            if (!document.querySelector('link[href="'+href+'"]')) {
                const l = document.createElement('link');
                l.rel = 'stylesheet';
                l.href = href;
                document.head.appendChild(l);
            }
        });

        const script = document.createElement('script');
        script.src = base_url + 'ckeditorGPLlicense/ckeditor5-builder-46.0.0/ckeditor5/ckeditor5.js';
        script.defer = true;
        script.onload = initQueuedEditors;
        document.head.appendChild(script);

        window.__CKE5_QUEUE = [];
        window.__CKE5_INIT_READY = false;

        function initQueuedEditors() {
            window.__CKE5_INIT_READY = true;
            window.__CKE5_QUEUE.forEach(cfg => createEditor(cfg));
            window.__CKE5_QUEUE = [];
        }

        window.__CKE5_CREATE = function(cfg) {
            if (window.__CKE5_INIT_READY) createEditor(cfg);
            else window.__CKE5_QUEUE.push(cfg);
        };

        function resolveEditorClass() {
            if (window.CKEDITOR && CKEDITOR.ClassicEditor) return CKEDITOR.ClassicEditor;
            if (window.ClassicEditor) return window.ClassicEditor;
            for (const k in window) {
                if (window.hasOwnProperty(k)) {
                    const v = window[k];
                    if (v && typeof v === 'function' && v.create && k.toLowerCase().includes('editor')) {
                        return v;
                    }
                }
            }
            console.warn('CKEditor5: clase de editor no encontrada.');
            return null;
        }

        function createEditor(cfg) {
            const EditorClass = resolveEditorClass();
            if (!EditorClass) return;
            EditorClass.create(cfg.el, cfg.config)
                .then(editor => {
                    window.__CKE5_INSTANCES = window.__CKE5_INSTANCES || {};
                    window.__CKE5_INSTANCES[cfg.el.id] = editor;
                    const form = cfg.el.closest('form');
                    if (form && !form.__ckeSyncAttached) {
                        form.addEventListener('submit', () => {
                            Object.values(window.__CKE5_INSTANCES).forEach(ed => {
                                if (ed.updateSourceElement) ed.updateSourceElement();
                                else if (ed.sourceElement) ed.sourceElement.value = ed.getData();
                            });
                        });
                        form.__ckeSyncAttached = true;
                    }
                })
                .catch(err => console.error('CKEditor5 init error:', err));
        }
    }

    const el = document.getElementById('{/literal}{$editorId}{literal}');
    enqueueEditor(el);

})();
</script>
{/literal}