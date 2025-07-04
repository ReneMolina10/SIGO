
		<div class="input-group archivo">
			<input type="text" class="form-control" id="{$f.campo}" name="{$f.campo}" value="{$d[$f.campo]|default:""}" placeholder="{$f.holder|default:''}">
			<div class="input-group-btn">
				<a class="btn btn-primary" id="dialog_{$f.campo}" >...</a>
			</div><!-- /btn-group -->    
		</div><!-- /input-group --> 


{if $libJSFinder == "0"}



    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

		<!-- elfinder css -->
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/commands.css"    type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/common.css"      type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/contextmenu.css" type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/cwd.css"         type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/dialog.css"      type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/fonts.css"       type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/navbar.css"      type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/places.css"      type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/quicklook.css"   type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/statusbar.css"   type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/theme.css"       type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/toast.css"       type="text/css">
	<link rel="stylesheet" href="{$BASE_URL}elFinder-2.1.29/css/toolbar.css"     type="text/css">


<!-- 
	<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
	-->

	<!-- Section JavaScript -->
	<!-- jQuery and jQuery UI (REQUIRED) -->
	<!--[if lt IE 9]>
	<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<!--<![endif]-->
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>



	<!-- elfinder core -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.version.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/jquery.elfinder.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.mimetypes.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.options.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.options.netmount.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.history.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.command.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/elFinder.resources.js"></script>

	<!-- elfinder dialog -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/jquery.dialogelfinder.js"></script>

	<!-- elfinder default lang -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/i18n/elfinder.en.js"></script>

	<!-- elfinder ui -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/button.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/contextmenu.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/cwd.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/dialog.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/fullscreenbutton.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/navbar.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/navdock.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/overlay.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/panel.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/path.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/places.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/searchbutton.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/sortbutton.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/stat.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/toast.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/toolbar.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/tree.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/uploadButton.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/viewbutton.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/ui/workzone.js"></script>

	<!-- elfinder commands -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/archive.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/back.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/copy.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/cut.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/chmod.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/colwidth.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/download.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/duplicate.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/edit.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/empty.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/extract.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/forward.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/fullscreen.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/getfile.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/help.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/hidden.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/home.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/info.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/mkdir.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/mkfile.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/netmount.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/open.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/opendir.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/paste.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/places.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/quicklook.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/quicklook.plugins.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/reload.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/rename.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/resize.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/restore.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/rm.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/search.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/selectall.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/selectinvert.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/selectnone.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/sort.js"></script>	
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/undo.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/up.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/upload.js"></script>
	<script src="{$BASE_URL}elFinder-2.1.29/js/commands/view.js"></script>

	<!-- elfinder 1.x connector API support (OPTIONAL) -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/proxy/elFinderSupportVer1.js"></script>

	<!-- Extra contents editors (OPTIONAL) -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/extras/editors.default.js"></script>

	<!-- GoogleDocs Quicklook plugin for GoogleDrive Volume (OPTIONAL) -->
	<script src="{$BASE_URL}elFinder-2.1.29/js/extras/quicklook.googledocs.js"></script>

{/if}
	<script>
		{literal}
		$(document).ready(function() {
		{/literal}
			$('#dialog_{$f.campo}').click(function() 
		{literal}
			{
				var fm = $('<div/>').dialogelfinder({
					{/literal}
					url : '{$BASE_URL}elFinder-2.1.29/php/connector.minimal.php?idses=misitio&numselec=0',
					{literal}
					lang : 'en',
					width : 840,
					destroyOnClose : true,
					getFileCallback : function(files, fm) {
						{/literal}
						$('#{$f.campo}').val(files.url);
						{literal}
						//console.log(files);
					},
					commandsOptions : {
						getfile : {
							oncomplete : 'close',
							folders : false
						}
					}
				}).dialogelfinder('instance');
			});

		});
		{/literal}
	</script>