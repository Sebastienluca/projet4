var Editeur = {

	init: function(){

		// Récupére id du formulaire 
		var ajonewsElt = document.getElementById("ajonews");
		if (ajonewsElt) 
		{
		// Récupére le textarea et lui attributs un id
		var textareaElt = document.getElementById('ajonews').getElementsByTagName('textarea')[0];
		textareaElt.id = "editable";
		}
		
		tinymce.init({
			selector: 'textarea#editable', //selection id du textarea pour l'éditeur tinymce
			language : "fr_FR", // langue
			theme: 'modern',
			/*width: 650,*/ //commenté pour l\'avoir en pourcentage.
			height: 300,
			
			// url au niveau de la source par l'onglet upload
			//images_upload_url: '../images/medias/postAcceptor.php',
			//images_upload_base_path: '../images/medias',

			paste_data_images: true,
			image_advtab: true,

			// url au niveau de la source..
			/*file_browser_callback: function(field_name, url, type, win) {
				win.document.getElementById(field_name).value = '../images/medias/';
			},*/

			//images_upload_credentials: true,

			image_title: true,
			// enable automatic uploads of images represented by blob or data URIs
			automatic_uploads: true,
			images_reuse_filename: true,

			style_formats: [
			  {title: 'Image Left', selector: 'img', styles: {
				'float' : 'left',
				'margin': '0 10px 0 10px'
			  }},
			  {title: 'Image Right', selector: 'img', styles: {
				'float' : 'right',
				'margin': '0 10px 0 10px'
			  }}
			],

			//Téléchargement de l'image ds le contenu de l'éditeur.

			/*images_upload_handler: function (blobInfo, success, failure)
			{
				var xhr, formData;

				xhr = new XMLHttpRequest();
				xhr.withCredentials = false;
				xhr.open('POST', '/postAcceptor.php'); //execute le fichier upload

				xhr.onload = function() {
				  var json;

				  console.log(json);

				  if (xhr.status < 200 || xhr.status >= 300) {
					failure('HTTP Error: ' + xhr.status);
					return;
				  }

				  json = JSON.parse(xhr.responseText);

				  if (!json || typeof json.location != 'string') {
					failure('Invalid JSON: ' + xhr.responseText);
					return;
				  }
				  success(json.location);

				  console.log(location);
				};

				formData = new FormData();
				formData.append('file', blobInfo.blob(), blobInfo.filename());

				xhr.send(formData);
			},*/

			/*file_picker_callback: function (callback, value, meta) {
				if (meta.filetype == 'image') {
					var input = document.getElementById('my-file');
					input.click();
					input.onchange = function () {
						var file = input.files[0];
						var reader = new FileReader();
						reader.onload = function (e) {
							callback(e.target.result, {
								alt: file.name
							});
						};
						reader.readAsDataURL(file);
					};
				}
			},*/
			  
			/*extended_valid_elements : 
			"hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],a[href|name]",
*/
			/*plugins: [
			  'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
			  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
			  'save table contextmenu directionality emoticons template paste textcolor'
			],*/

			content_css: '../css/content.css',
			//advlist_bullet_styles: 'square',
			//advlist_number_styles: 'lower-alpha,lower-roman,upper-alpha,upper-roman',
			//toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
		});	

		/*tinymce.activeEditor.uploadImages(function(success) {
		  $.post('ajax/post.php', tinymce.activeEditor.getContent()).done(function() {
			console.log("Uploaded images and posted content as an ajax request.");
		  });
		});*/

	},
}
