import {
  Essentials, Paragraph, Enter, ClassicEditor, 
  Alignment, Autoformat, AutoImage, AutoLink, Autosave,
  BlockQuote, Bold, Bookmark, Code, CodeBlock, FindAndReplace,
  FontBackgroundColor, FontColor, FontFamily, FontSize, Fullscreen,
  GeneralHtmlSupport, Heading, Highlight, HorizontalLine, HtmlComment, HtmlEmbed,
  ImageBlock, ImageCaption, ImageInline, ImageInsert, ImageInsertViaUrl,
  ImageResize, ImageStyle, ImageTextAlternative, ImageToolbar, ImageUpload,
  Indent, IndentBlock, Italic, Link, LinkImage, List, ListProperties, MediaEmbed,
  PageBreak, PasteFromOffice, PlainTableOutput, RemoveFormat, ShowBlocks,
  SimpleUploadAdapter, SourceEditing, SpecialCharacters, SpecialCharactersArrows,
  SpecialCharactersCurrency, SpecialCharactersEssentials, SpecialCharactersLatin,
  SpecialCharactersMathematical, SpecialCharactersText, Strikethrough, Style,
  Subscript, Superscript, Table, TableCaption, TableCellProperties, TableColumnResize,
  TableLayout, TableProperties, TableToolbar, TextPartLanguage, TextTransformation, TodoList, Underline, WordCount
} from 'ckeditor5';
import translations from 'ckeditor5/translations/es.js';

const editorConfig = {
  licenseKey: window.CKEDITOR_LICENSE_KEY || 'GPL',
  language: 'es',
  translations: [ translations ],
  placeholder: 'Escribe aquí…',  
  plugins: [
    Essentials, Enter, Paragraph, Alignment, Autoformat, AutoImage, AutoLink, Autosave,
    BlockQuote, Bold, Bookmark, Code, CodeBlock, FindAndReplace,
    FontBackgroundColor, FontColor, FontFamily, FontSize, Fullscreen,
    GeneralHtmlSupport, Heading, Highlight, HorizontalLine, HtmlComment, HtmlEmbed,
    ImageBlock, ImageCaption, ImageInline, ImageInsert, ImageInsertViaUrl,
    ImageResize, ImageStyle, ImageTextAlternative, ImageToolbar, ImageUpload,
    Indent, IndentBlock, Italic, Link, LinkImage, List, ListProperties, MediaEmbed,
    PageBreak, PasteFromOffice, PlainTableOutput, RemoveFormat, ShowBlocks,
    SimpleUploadAdapter, SourceEditing, SpecialCharacters, SpecialCharactersArrows,
    SpecialCharactersCurrency, SpecialCharactersEssentials, SpecialCharactersLatin,
    SpecialCharactersMathematical, SpecialCharactersText, Strikethrough, Style,
    Subscript, Superscript, Table, TableCaption, TableCellProperties, TableColumnResize,
    TableLayout, TableProperties, TableToolbar, TextPartLanguage, TextTransformation, TodoList, Underline, WordCount
  ],
  toolbar: {
    items: [
      'undo','redo','|',
      'sourceEditing','showBlocks','findAndReplace','textPartLanguage','fullscreen','|',
      'heading','style','|',
      'fontSize','fontFamily','fontColor','fontBackgroundColor','|',
      'bold','italic','underline','strikethrough','subscript','superscript','code','removeFormat','|',
      'specialCharacters','horizontalLine','pageBreak','link','bookmark','insertImage','mediaEmbed',
      'insertTable','insertTableLayout','highlight','blockQuote','codeBlock','htmlEmbed','|',
      'alignment','|','bulletedList','numberedList','todoList','outdent','indent'
    ],
    shouldNotGroupWhenFull: false
  },
  fontFamily: { supportAllValues: true },
  fontSize:   { options: [10,12,14,'default',18,20,22], supportAllValues: true },
  fullscreen: {
    onEnterCallback: c => c.classList.add(
      'editor-container','editor-container_classic-editor',
      'editor-container_include-style','editor-container_include-word-count',
      'editor-container_include-fullscreen','main-container'
    )
  },
  heading: {
    options: [
      { model:'paragraph', title:'Paragraph', class:'ck-heading_paragraph' },
      { model:'heading1', view:'h1', title:'Heading 1', class:'ck-heading_heading1' },
      { model:'heading2', view:'h2', title:'Heading 2', class:'ck-heading_heading2' },
      { model:'heading3', view:'h3', title:'Heading 3', class:'ck-heading_heading3' },
      { model:'heading4', view:'h4', title:'Heading 4', class:'ck-heading_heading4' },
      { model:'heading5', view:'h5', title:'Heading 5', class:'ck-heading_heading5' },
      { model:'heading6', view:'h6', title:'Heading 6', class:'ck-heading_heading6' }
    ]
  },
  htmlSupport: { allow: [{ name:/^.*$/, styles:true, attributes:true, classes:true }] },
  image: {
    toolbar: [
      'toggleImageCaption','imageTextAlternative','|',
      'imageStyle:inline','imageStyle:wrapText','imageStyle:breakText','|','resizeImage'
    ]
  },
  list: { properties: { styles:true, startIndex:true, reversed:true } },
  table: { contentToolbar: ['tableColumn','tableRow','mergeTableCells','tableProperties','tableCellProperties'] }
};

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.editor-container').forEach(container => {
    const editable = container.querySelector('.ck5-editor');
    const wcBox    = container.querySelector('.editor_container__word-count');
    if (!editable) return;

    // ← AÑADE ESTO: si el div está vacío, mete un <p> para que Enter funcione.
    if (!editable.innerHTML.trim()) editable.innerHTML = '<p>&nbsp;</p>';

    ClassicEditor.create(editable, editorConfig).then(editor => {
  editable.ckeditorInstance = editor;

  // MONTAR WordCount (como ya tenías)
  if (editor.plugins.has('WordCount') && wcBox) {
    wcBox.appendChild(editor.plugins.get('WordCount').wordCountContainer);
  }

  // --- ANTI-INTERFERENCIAS DE ENTER (de otros scripts del sitio) ---
  const domEditable = editor.ui.view.editable.element;

  // Garantiza modo edición
  editor.isReadOnly = false;

  // Captura el Enter antes de que otros listeners globales lo anulen
  domEditable.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      e.stopImmediatePropagation(); // no hacemos preventDefault: dejamos que CKEditor lo maneje
    }
  }, true); // captura
  // --- FIN ANTI-INTERFERENCIAS ---
}).catch(console.error);

  });

  // Sincroniza al hidden en cualquier submit (ya lo tienes)
  document.addEventListener('submit', () => {
    document.querySelectorAll('.editor-container .ck5-editor').forEach(ed => {
      const name   = ed.getAttribute('data-field');
      const hidden = document.querySelector(`input[type="hidden"][name="${name}"]`);
      if (hidden && ed.ckeditorInstance) hidden.value = ed.ckeditorInstance.getData();
    });
  }, true);
});

