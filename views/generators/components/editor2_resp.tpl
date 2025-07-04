		<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
		<script>




		CKEditorInit('#{$f.campo}');

		//CKEditor 5
  var CKEditorArray = [];

  function CKEditorInit(name){





      ClassicEditor


          .create(document.querySelector(name), {
        toolbar:  {
   items: [
        'heading', '|',
        'alignment', '|',
        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
        'link', '|',
        'bulletedList', 'numberedList', 'todoList',
        '-', // break point
        'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
        'code', 'codeBlock', '|',
        'insertTable', '|',
        'outdent', 'indent', '|',
        'uploadImage', 'blockQuote', '|',
        'undo', 'redo'
    ],

    shouldNotGroupWhenFull: false
}
    } )
          .then(editor => {
              CKEditorArray[name] = editor;
          })
          .catch(error => {
              console.error(error);
          });
  }

  


  		</script>
  		